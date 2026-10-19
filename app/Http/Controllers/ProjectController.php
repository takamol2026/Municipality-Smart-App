<?php

namespace App\Http\Controllers;

use App\Enums\PublishStatus;
use App\Enums\RecordStatus;
use App\Http\Requests\ProjectStoreValidation;
use App\Http\Requests\ProjectUpdateValidation;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\ProjectMedia;
use App\Support\StoredImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ProjectController extends Controller
{
    public function index(Request $request): View
    {
        $projects = Project::query()
            ->with(['user', 'category', 'media'])
            ->when($request->filled('name'), function ($query) use ($request) {
                $query->where('title', 'like', '%'.$request->string('name').'%');
            })
            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where('status', $request->string('status'));
            })
            ->latest('id')
            ->paginate(15)
            ->withQueryString();

        return view('projects.index', compact('projects'));
    }

    public function create(): View
    {
        return view('projects.create', [
            'categories' => $this->categories(),
        ]);
    }

    public function store(ProjectStoreValidation $request): RedirectResponse
    {
        $validated = $request->validated();
        unset($validated['media']);

        $validated['slug'] = $validated['slug'] ?: Str::slug($validated['title']);
        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['status'] = RecordStatus::from($validated['status']);
        $validated['status_publish'] = PublishStatus::from($validated['status_publish']);
        $validated['user_id'] = $request->user()->id;

        if ($request->hasFile('image')) {
            $validated['image'] = StoredImage::store($request->file('image'), 'projects');
        }

        $project = Project::create($validated);
        $this->storeNewMedia($project, $request);

        return redirect()
            ->route('projects.index')
            ->with('success', __('projects.saved'));
    }

    public function edit(Project $project): View
    {
        $project->load('media');

        return view('projects.edit', [
            'project' => $project,
            'categories' => $this->categories(),
        ]);
    }

    public function update(ProjectUpdateValidation $request, Project $project): RedirectResponse
    {
        $validated = $request->validated();
        unset($validated['media'], $validated['existing_media']);

        $validated['slug'] = $validated['slug'] ?: Str::slug($validated['title']);
        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['status'] = RecordStatus::from($validated['status']);
        $validated['status_publish'] = PublishStatus::from($validated['status_publish']);

        if ($request->hasFile('image')) {
            $this->deleteFile($project->image);
            $validated['image'] = StoredImage::store($request->file('image'), 'projects');
        }

        $project->update($validated);
        $this->updateExistingMedia($project, $request);
        $this->storeNewMedia($project, $request);

        return redirect()
            ->route('projects.index')
            ->with('success', __('projects.updated'));
    }

    public function downloadImage(Project $project): StreamedResponse
    {
        abort_unless($project->image && Storage::disk('public')->exists($project->image), 404);

        return Storage::disk('public')->download($project->image, basename($project->image));
    }

    public function downloadMedia(Project $project, ProjectMedia $projectMedia): StreamedResponse
    {
        abort_unless($projectMedia->project_id === $project->id && $projectMedia->file && Storage::disk('public')->exists($projectMedia->file), 404);

        $extension = pathinfo($projectMedia->file, PATHINFO_EXTENSION);
        $base = $projectMedia->title ? (Str::slug($projectMedia->title) ?: 'media') : pathinfo($projectMedia->file, PATHINFO_FILENAME);
        $name = $extension ? $base.'.'.$extension : $base;

        return Storage::disk('public')->download($projectMedia->file, $name);
    }

    public function destroyMedia(Project $project, ProjectMedia $projectMedia): RedirectResponse
    {
        abort_unless($projectMedia->project_id === $project->id, 404);

        $this->deleteFile($projectMedia->file);
        $this->deleteFile($projectMedia->thumbnail);
        $projectMedia->delete();

        return redirect()
            ->route('projects.edit', $project)
            ->with('success', __('common.media_deleted'));
    }

    public function destroy(Project $project): RedirectResponse
    {
        foreach ($project->media as $media) {
            $this->deleteFile($media->file);
            $this->deleteFile($media->thumbnail);
            $media->delete();
        }

        $this->deleteFile($project->image);
        $project->delete();

        return redirect()
            ->route('projects.index')
            ->with('success', __('projects.deleted'));
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection<int, ProjectCategory>
     */
    private function categories()
    {
        return ProjectCategory::query()
            ->orderBy('name')
            ->get();
    }

    private function storeNewMedia(Project $project, Request $request): void
    {
        foreach ($request->input('media') ?? [] as $index => $item) {
            $file = $request->file("media.$index.file");

            if (! $file instanceof UploadedFile) {
                continue;
            }

            $thumbnail = $request->file("media.$index.thumbnail");

            $project->media()->create([
                'title' => $item['title'] ?? null,
                'type' => filled($item['type'] ?? null) ? $item['type'] : $this->guessMediaType($file),
                'file' => StoredImage::store($file, 'project-media'),
                'thumbnail' => $thumbnail instanceof UploadedFile
                    ? StoredImage::store($thumbnail, 'project-media/thumbnails')
                    : null,
                'sort_order' => $item['sort_order'] ?? $index,
                'status' => RecordStatus::Active,
                'user_id' => $request->user()->id,
            ]);
        }
    }

    private function updateExistingMedia(Project $project, Request $request): void
    {
        foreach ($request->input('existing_media') ?? [] as $id => $item) {
            $media = $project->media()->whereKey($id)->first();

            if (! $media) {
                continue;
            }

            $data = [
                'title' => $item['title'] ?? $media->title,
                'type' => filled($item['type'] ?? null) ? $item['type'] : $media->type,
                'sort_order' => $item['sort_order'] ?? $media->sort_order,
            ];

            $file = $request->file("existing_media.$id.file");
            if ($file instanceof UploadedFile) {
                $this->deleteFile($media->file);
                $data['file'] = StoredImage::store($file, 'project-media');
                $data['type'] = filled($item['type'] ?? null) ? $item['type'] : $this->guessMediaType($file);
            }

            $thumbnail = $request->file("existing_media.$id.thumbnail");
            if ($thumbnail instanceof UploadedFile) {
                $this->deleteFile($media->thumbnail);
                $data['thumbnail'] = StoredImage::store($thumbnail, 'project-media/thumbnails');
            }

            $media->update($data);
        }
    }

    private function guessMediaType(UploadedFile $file): string
    {
        $mime = (string) $file->getMimeType();

        if (str_starts_with($mime, 'image/')) {
            return 'image';
        }

        if (str_starts_with($mime, 'video/')) {
            return 'video';
        }

        return 'document';
    }

    private function deleteFile(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
