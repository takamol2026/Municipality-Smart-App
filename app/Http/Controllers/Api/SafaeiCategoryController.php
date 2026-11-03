<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SafaeiCategoryController extends ApiController
{
    public function index(Request $request): JsonResponse
    {
        $query = $this->view('vw_safaei_categories');
        $this->applySearch($query, $request, 'name');

        $categories = $query
            ->latest('id')
            ->paginate($this->perPage($request))
            ->withQueryString();

        return $this->paginated($categories, fn (object $category) => $this->payload($category));
    }

    public function show(int $category): JsonResponse
    {
        return response()->json([
            'data' => $this->payload($this->findView('vw_safaei_categories', $category)),
        ]);
    }

    private function payload(object $category): array
    {
        return [
            'id' => (int) $category->id,
            'name' => $category->name,
            'lang' => $category->lang,
            'lang_label' => $this->langLabel($category->lang),
            'description' => $category->description,
            'status' => $category->status,
            'safaeis_count' => (int) $category->safaeis_count,
        ];
    }
}
