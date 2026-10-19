<?php

namespace App\Http\Controllers\Api;

use App\Enums\RecordStatus;
use App\Models\AnnouncementCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AnnouncementCategoryController extends ApiController
{
    public function index(Request $request): JsonResponse
    {
        $query = AnnouncementCategory::query()
            ->withCount(['announcements' => fn ($announcements) => $announcements->where('status', RecordStatus::Active)])
            ->where('status', RecordStatus::Active);

        $this->applySearch($query, $request, 'name');

        $categories = $query
            ->orderBy('sort_order')
            ->latest('id')
            ->paginate($this->perPage($request))
            ->withQueryString();

        return $this->paginated($categories, fn (AnnouncementCategory $category) => $this->payload($category));
    }

    public function show(int $category): JsonResponse
    {
        $category = AnnouncementCategory::query()
            ->withCount(['announcements' => fn ($announcements) => $announcements->where('status', RecordStatus::Active)])
            ->where('status', RecordStatus::Active)
            ->findOrFail($category);

        return response()->json([
            'data' => $this->payload($category),
        ]);
    }

    private function payload(AnnouncementCategory $category): array
    {
        return [
            'id' => $category->id,
            'name' => $category->name,
            'lang' => $this->enumValue($category->lang),
            'lang_label' => $category->lang?->label(),
            'slug' => $category->slug,
            'status' => $this->enumValue($category->status),
            'sort_order' => $category->sort_order,
            'announcements_count' => $category->announcements_count,
        ];
    }
}
