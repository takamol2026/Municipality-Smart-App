<?php

namespace App\Http\Controllers;

use App\Enums\RecordStatus;
use App\Http\Requests\ProjectCategoryStoreValidation;
use App\Http\Requests\ProjectCategoryUpdateValidation;
use App\Models\ProjectCategory;
use App\Support\StoredImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ProjectCategoryController extends Controller
{
    public function index(Request $request): View
    {
        $categories = ProjectCategory::query()
            ->with('user')
            ->when($request->filled('name'), function ($query) use ($request) {
                $query->where('name', 'like', '%'.$request->string('name').'%');
            })
            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where('status', $request->string('status'));
            })
            ->latest('id')
            ->paginate(15)
            ->withQueryString();

        return view('project-categories.index', compact('categories'));
    }

    public function create(): View
    {
        return view('project-categories.create');
    }

    public function store(ProjectCategoryStoreValidation $request): RedirectResponse
    {
        $validated = $request->validated();

        $validated['slug'] = $validated['slug'] ?: Str::slug($validated['name']);
        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['status'] = RecordStatus::from($validated['status']);
        $validated['user_id'] = $request->user()->id;

        if ($request->hasFile('img')) {
            $validated['img'] = StoredImage::store($request->file('img'), 'project-categories');
        }

        ProjectCategory::create($validated);

        return redirect()
            ->route('project-categories.index')
            ->with('success', __('common.category_saved'));
    }

    public function edit(ProjectCategory $projectCategory): View
    {
        return view('project-categories.edit', [
            'category' => $projectCategory,
        ]);
    }

    public function update(ProjectCategoryUpdateValidation $request, ProjectCategory $projectCategory): RedirectResponse
    {
        $validated = $request->validated();

        $validated['slug'] = $validated['slug'] ?: Str::slug($validated['name']);
        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['status'] = RecordStatus::from($validated['status']);

        if ($request->hasFile('img')) {
            $this->deleteImage($projectCategory->img);
            $validated['img'] = StoredImage::store($request->file('img'), 'project-categories');
        }

        $projectCategory->update($validated);

        return redirect()
            ->route('project-categories.index')
            ->with('success', __('common.category_updated'));
    }

    public function downloadImage(ProjectCategory $projectCategory): StreamedResponse
    {
        abort_unless($projectCategory->img && Storage::disk('public')->exists($projectCategory->img), 404);

        return Storage::disk('public')->download($projectCategory->img, basename($projectCategory->img));
    }

    public function destroy(ProjectCategory $projectCategory): RedirectResponse
    {
        if ($projectCategory->projects()->exists()) {
            return redirect()
                ->route('project-categories.index')
                ->with('error', __('projects.category_delete_blocked'));
        }

        $this->deleteImage($projectCategory->img);
        $projectCategory->delete();

        return redirect()
            ->route('project-categories.index')
            ->with('success', __('common.category_deleted'));
    }

    private function deleteImage(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
