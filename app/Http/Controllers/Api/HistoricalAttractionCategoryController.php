<?php

namespace App\Http\Controllers\Api;

use App\Enums\RecordStatus;
use App\Models\HistoricalAttractionCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HistoricalAttractionCategoryController extends ApiController
{
    public function index(Request $request): JsonResponse
    {
        $query = HistoricalAttractionCategory::query()
            ->withCount(['attractions' => fn ($attractions) => $attractions->where('status', RecordStatus::Active)])
            ->where('status', RecordStatus::Active);

        $this->applySearch($query, $request, 'name');

        $categories = $query
            ->orderBy('sort_order')
            ->latest('id')
            ->paginate($this->perPage($request))
            ->withQueryString();

        return $this->paginated($categories, fn (HistoricalAttractionCategory $category) => $this->payload($category));
    }

    public function show(int $category): JsonResponse
    {
        $category = HistoricalAttractionCategory::query()
            ->withCount(['attractions' => fn ($attractions) => $attractions->where('status', RecordStatus::Active)])
            ->where('status', RecordStatus::Active)
            ->findOrFail($category);

        return response()->json([
            'data' => $this->payload($category),
        ]);
    }

    private function payload(HistoricalAttractionCategory $category): array
    {
        return [
            'id' => $category->id,
            'name' => $category->name,
            'slug' => $category->slug,
            'description' => $category->description,
            'image_url' => $this->fileUrl($category->image),
            'status' => $this->enumValue($category->status),
            'sort_order' => $category->sort_order,
            'attractions_count' => $category->attractions_count,
        ];
    }
}
