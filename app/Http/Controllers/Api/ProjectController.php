<?php

namespace App\Http\Controllers\Api;

use App\Enums\PublishStatus;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ProjectController extends ApiController
{
    public function index(Request $request): JsonResponse
    {
        $query = $this->view('vw_projects');
        $this->applySearch($query, $request, 'title');

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->integer('category_id'));
        }

        if ($request->filled('status_publish')) {
            $query->where('status_publish', $request->string('status_publish')->toString());
        }

        $projects = $query
            ->orderBy('sort_order')
            ->latest('id')
            ->paginate($this->perPage($request))
            ->withQueryString();

        $media = $this->rowsFor('vw_project_media', 'project_id', $projects->getCollection()->pluck('id'))
            ->sortBy(fn ($item) => sprintf('%010d-%010d', $item->sort_order, $item->id))
            ->groupBy(fn ($item) => (string) $item->project_id);

        return $this->paginated($projects, fn (object $project) => $this->payload($project, $media));
    }

    public function show(int $project): JsonResponse
    {
        $project = $this->findView('vw_projects', $project);
        $media = $this->rowsFor('vw_project_media', 'project_id', [$project->id])
            ->sortBy(fn ($item) => sprintf('%010d-%010d', $item->sort_order, $item->id))
            ->groupBy(fn ($item) => (string) $item->project_id);

        return response()->json([
            'data' => $this->payload($project, $media),
        ]);
    }

    private function payload(object $project, Collection $media): array
    {
        return [
            'id' => (int) $project->id,
            'title' => $project->title,
            'slug' => $project->slug,
            'short_description' => $project->short_description,
            'description' => $project->description,
            'location' => $project->location,
            'benefits' => $project->benefits,
            'start_date' => $this->day($project->start_date),
            'end_date' => $this->day($project->end_date),
            'image_url' => $this->viewUrl($project->image_url),
            'status' => $project->status,
            'status_publish' => $project->status_publish,
            'status_publish_label' => PublishStatus::tryFrom((string) $project->status_publish)?->label(),
            'sort_order' => (int) $project->sort_order,
            'category' => $this->categoryOf($project),
            'media' => $media->get((string) $project->id, collect())->map(fn ($item) => [
                'id' => (int) $item->id,
                'type' => $item->type,
                'type_label' => $this->mediaTypeLabel($item->type),
                'title' => $item->title,
                'file_url' => $this->viewUrl($item->file_url),
                'thumbnail_url' => $this->viewUrl($item->thumbnail_url),
                'sort_order' => (int) $item->sort_order,
            ])->values(),
            'created_at' => $this->iso($project->created_at),
        ];
    }
}
