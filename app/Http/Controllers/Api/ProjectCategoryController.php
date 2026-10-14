<?php

namespace App\Http\Controllers\Api;

use App\Enums\RecordStatus;
use App\Models\ProjectCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProjectCategoryController extends ApiController
{
    public function index(Request $request): JsonResponse
    {
        $query = ProjectCategory::query()
            ->withCount(['projects' => fn ($projects) => $projects->where('status', RecordStatus::Active)])
            ->where('status', RecordStatus::Active);

        $this->applySearch($query, $request, 'name');

        $categories = $query
            ->orderBy('sort_order')
            ->latest('id')
            ->paginate($this->perPage($request))
            ->withQueryString();

        return $this->paginated($categories, fn (ProjectCategory $category) => $this->payload($category));
    }

    public function show(int $category): JsonResponse
    {
        $category = ProjectCategory::query()
            ->withCount(['projects' => fn ($projects) => $projects->where('status', RecordStatus::Active)])
            ->where('status', RecordStatus::Active)
            ->findOrFail($category);

        return response()->json([
            'data' => $this->payload($category),
        ]);
    }

    private function payload(ProjectCategory $category): array
    {
        return [
            'id' => $category->id,
            'name' => $category->name,
            'slug' => $category->slug,
            'description' => $category->description,
            'image_url' => $this->fileUrl($category->img),
            'status' => $this->enumValue($category->status),
            'sort_order' => $category->sort_order,
            'projects_count' => $category->projects_count,
        ];
    }
}
