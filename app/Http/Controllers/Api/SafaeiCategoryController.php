<?php

namespace App\Http\Controllers\Api;

use App\Enums\RecordStatus;
use App\Models\SafaeiCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SafaeiCategoryController extends ApiController
{
    public function index(Request $request): JsonResponse
    {
        $query = SafaeiCategory::query()
            ->withCount('safaeis')
            ->where('status', RecordStatus::Active);

        $this->applySearch($query, $request, 'name');

        $categories = $query
            ->latest('id')
            ->paginate($this->perPage($request))
            ->withQueryString();

        return $this->paginated($categories, fn (SafaeiCategory $category) => $this->payload($category));
    }

    public function show(int $category): JsonResponse
    {
        $category = SafaeiCategory::query()
            ->withCount('safaeis')
            ->where('status', RecordStatus::Active)
            ->findOrFail($category);

        return response()->json([
            'data' => $this->payload($category),
        ]);
    }

    private function payload(SafaeiCategory $category): array
    {
        return [
            'id' => $category->id,
            'name' => $category->name,
            'lang' => $this->enumValue($category->lang),
            'lang_label' => $category->lang?->label(),
            'description' => $category->description,
            'status' => $this->enumValue($category->status),
            'safaeis_count' => $category->safaeis_count,
        ];
    }
}
