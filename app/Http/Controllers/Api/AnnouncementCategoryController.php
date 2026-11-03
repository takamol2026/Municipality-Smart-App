<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AnnouncementCategoryController extends ApiController
{
    public function index(Request $request): JsonResponse
    {
        $query = $this->view('vw_announcement_categories');
        $this->applySearch($query, $request, 'name');

        $categories = $query
            ->orderBy('sort_order')
            ->latest('id')
            ->paginate($this->perPage($request))
            ->withQueryString();

        return $this->paginated($categories, fn (object $category) => $this->payload($category));
    }

    public function show(int $category): JsonResponse
    {
        return response()->json([
            'data' => $this->payload($this->findView('vw_announcement_categories', $category)),
        ]);
    }

    private function payload(object $category): array
    {
        return [
            'id' => (int) $category->id,
            'name' => $category->name,
            'lang' => $category->lang,
            'lang_label' => $this->langLabel($category->lang),
            'slug' => $category->slug,
            'status' => $category->status,
            'sort_order' => (int) $category->sort_order,
            'announcements_count' => (int) $category->announcements_count,
        ];
    }
}
