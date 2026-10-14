<?php

namespace App\Http\Controllers\Api;

use App\Enums\RecordStatus;
use App\Models\MapCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MapCategoryController extends ApiController
{
    public function index(Request $request): JsonResponse
    {
        $query = MapCategory::query()
            ->withCount(['locations' => fn ($locations) => $locations->where('status', RecordStatus::Active)])
            ->where('status', RecordStatus::Active);

        $this->applySearch($query, $request, 'name');

        $categories = $query
            ->orderBy('sort_order')
            ->latest('id')
            ->paginate($this->perPage($request))
            ->withQueryString();

        return $this->paginated($categories, fn (MapCategory $category) => $this->payload($category));
    }

    public function show(int $category): JsonResponse
    {
        $category = MapCategory::query()
            ->withCount(['locations' => fn ($locations) => $locations->where('status', RecordStatus::Active)])
            ->where('status', RecordStatus::Active)
            ->findOrFail($category);

        return response()->json([
            'data' => $this->payload($category),
        ]);
    }

    private function payload(MapCategory $category): array
    {
        return [
            'id' => $category->id,
            'name' => $category->name,
            'slug' => $category->slug,
            'description' => $category->description,
            'image_url' => $this->fileUrl($category->img),
            'status' => $this->enumValue($category->status),
            'sort_order' => $category->sort_order,
            'locations_count' => $category->locations_count,
        ];
    }
}
