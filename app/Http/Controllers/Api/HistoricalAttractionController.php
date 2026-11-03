<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HistoricalAttractionController extends ApiController
{
    public function index(Request $request): JsonResponse
    {
        $query = $this->view('vw_historical_attractions');
        $this->applySearch($query, $request, 'name');

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->integer('category_id'));
        }

        $attractions = $query
            ->orderBy('sort_order')
            ->latest('id')
            ->paginate($this->perPage($request))
            ->withQueryString();

        return $this->paginated($attractions, fn (object $attraction) => $this->payload($attraction));
    }

    public function show(int $attraction): JsonResponse
    {
        return response()->json([
            'data' => $this->payload($this->findView('vw_historical_attractions', $attraction)),
        ]);
    }

    private function payload(object $attraction): array
    {
        return [
            'id' => (int) $attraction->id,
            'name' => $attraction->name,
            'lang' => $attraction->lang,
            'lang_label' => $this->langLabel($attraction->lang),
            'slug' => $attraction->slug,
            'short_description' => $attraction->short_description,
            'description' => $attraction->description,
            'history' => $attraction->history,
            'address' => $attraction->address,
            'location' => $attraction->location,
            'latitude' => $attraction->latitude,
            'longitude' => $attraction->longitude,
            'image_url' => $this->viewUrl($attraction->image_url),
            'status' => $attraction->status,
            'sort_order' => (int) $attraction->sort_order,
            'category' => $this->categoryOf($attraction),
            'created_at' => $this->iso($attraction->created_at),
        ];
    }
}
