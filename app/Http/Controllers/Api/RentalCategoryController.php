<?php

namespace App\Http\Controllers\Api;

use App\Enums\RecordStatus;
use App\Models\RentalCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RentalCategoryController extends ApiController
{
    public function index(Request $request): JsonResponse
    {
        $query = RentalCategory::query()
            ->withCount(['rentals' => fn ($rentals) => $rentals->where('status', RecordStatus::Active)])
            ->where('status', RecordStatus::Active);

        $this->applySearch($query, $request, 'name');

        $categories = $query
            ->orderBy('sort_order')
            ->latest('id')
            ->paginate($this->perPage($request))
            ->withQueryString();

        return $this->paginated($categories, fn (RentalCategory $category) => $this->payload($category));
    }

    public function show(int $category): JsonResponse
    {
        $category = RentalCategory::query()
            ->withCount(['rentals' => fn ($rentals) => $rentals->where('status', RecordStatus::Active)])
            ->where('status', RecordStatus::Active)
            ->findOrFail($category);

        return response()->json([
            'data' => $this->payload($category),
        ]);
    }

    private function payload(RentalCategory $category): array
    {
        return [
            'id' => $category->id,
            'name' => $category->name,
            'lang' => $this->enumValue($category->lang),
            'lang_label' => $category->lang?->label(),
            'slug' => $category->slug,
            'description' => $category->description,
            'image_url' => $this->fileUrl($category->img),
            'status' => $this->enumValue($category->status),
            'sort_order' => $category->sort_order,
            'rentals_count' => $category->rentals_count,
        ];
    }
}
