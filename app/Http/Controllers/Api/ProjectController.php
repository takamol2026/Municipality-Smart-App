<?php

namespace App\Http\Controllers\Api;

use App\Enums\RecordStatus;
use App\Models\Project;
use App\Models\ProjectMedia;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProjectController extends ApiController
{
    public function index(Request $request): JsonResponse
    {
        $query = Project::query()
            ->with(['category', 'media' => fn ($media) => $media->where('status', RecordStatus::Active)])
            ->where('status', RecordStatus::Active);

        $this->applySearch($query, $request, 'title');

        if ($request->filled('category_id')) {
            $query->where('project_category_id', $request->integer('category_id'));
        }

        if ($request->filled('status_publish')) {
            $query->where('status_publish', $request->string('status_publish'));
        }

        $projects = $query
            ->orderBy('sort_order')
            ->latest('id')
            ->paginate($this->perPage($request))
            ->withQueryString();

        return $this->paginated($projects, fn (Project $project) => $this->payload($project));
    }

    public function show(int $project): JsonResponse
    {
        $project = Project::query()
            ->with(['category', 'media' => fn ($media) => $media->where('status', RecordStatus::Active)])
            ->where('status', RecordStatus::Active)
            ->findOrFail($project);

        return response()->json([
            'data' => $this->payload($project),
        ]);
    }

    private function payload(Project $project): array
    {
        return [
            'id' => $project->id,
            'title' => $project->title,
            'slug' => $project->slug,
            'short_description' => $project->short_description,
            'description' => $project->description,
            'location' => $project->location,
            'benefits' => $project->benefits,
            'start_date' => $this->date($project->start_date),
            'end_date' => $this->date($project->end_date),
            'image_url' => $this->fileUrl($project->image),
            'status' => $this->enumValue($project->status),
            'status_publish' => $this->enumValue($project->status_publish),
            'status_publish_label' => $project->status_publish?->label(),
            'sort_order' => $project->sort_order,
            'category' => $project->category ? [
                'id' => $project->category->id,
                'name' => $project->category->name,
                'slug' => $project->category->slug,
            ] : null,
            'media' => $project->media->map(fn (ProjectMedia $media) => [
                'id' => $media->id,
                'type' => $media->type,
                'type_label' => $media->typeLabel(),
                'title' => $media->title,
                'file_url' => $this->fileUrl($media->file),
                'thumbnail_url' => $this->fileUrl($media->previewPath()),
                'sort_order' => $media->sort_order,
            ])->values(),
            'created_at' => $project->created_at?->toIso8601String(),
        ];
    }
}
