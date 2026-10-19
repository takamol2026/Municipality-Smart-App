<?php

namespace App\Http\Controllers\Api;

use App\Enums\RecordStatus;
use App\Models\UrbanServiceCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UrbanServiceCategoryController extends ApiController
{
    public function index(Request $request): JsonResponse
    {
        $query = UrbanServiceCategory::query()
            ->withCount(['services' => fn ($services) => $services->where('status', RecordStatus::Active)])
            ->where('status', RecordStatus::Active);

        $this->applySearch($query, $request, 'name');

        $categories = $query
            ->orderBy('sort_order')
            ->latest('id')
            ->paginate($this->perPage($request))
            ->withQueryString();

        return $this->paginated($categories, fn (UrbanServiceCategory $category) => $this->payload($category));
    }

    public function show(int $category): JsonResponse
    {
        $category = UrbanServiceCategory::query()
            ->withCount(['services' => fn ($services) => $services->where('status', RecordStatus::Active)])
            ->where('status', RecordStatus::Active)
            ->findOrFail($category);

        return response()->json([
            'data' => $this->payload($category),
        ]);
    }

    private function payload(UrbanServiceCategory $category): array
    {
        return [
            'id' => $category->id,
            'name' => $category->name,
            'lang' => $this->enumValue($category->lang),
            'lang_label' => $category->lang?->label(),
            'slug' => $category->slug,
            'description' => $category->description,
            'status' => $this->enumValue($category->status),
            'sort_order' => $category->sort_order,
            'services_count' => $category->services_count,
        ];
    }
}
