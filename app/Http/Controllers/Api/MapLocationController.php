<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class MapLocationController extends ApiController
{
    public function index(Request $request): JsonResponse
    {
        $query = $this->view('vw_map_locations');
        $this->applySearch($query, $request, 'name');

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->integer('category_id'));
        }

        $locations = $query
            ->orderBy('sort_order')
            ->latest('id')
            ->paginate($this->perPage($request))
            ->withQueryString();

        $media = $this->rowsFor('vw_map_media', 'map_location_id', $locations->getCollection()->pluck('id'))
            ->sortByDesc('id')
            ->groupBy(fn ($item) => (string) $item->map_location_id);

        return $this->paginated($locations, fn (object $location) => $this->payload($location, $media));
    }

    public function show(int $location): JsonResponse
    {
        $location = $this->findView('vw_map_locations', $location);
        $media = $this->rowsFor('vw_map_media', 'map_location_id', [$location->id])
            ->sortByDesc('id')
            ->groupBy(fn ($item) => (string) $item->map_location_id);

        return response()->json([
            'data' => $this->payload($location, $media),
        ]);
    }

    private function payload(object $location, Collection $media): array
    {
        return [
            'id' => (int) $location->id,
            'name' => $location->name,
            'lang' => $location->lang,
            'lang_label' => $this->langLabel($location->lang),
            'slug' => $location->slug,
            'description' => $location->description,
            'address' => $location->address,
            'latitude' => $location->latitude,
            'longitude' => $location->longitude,
            'phone' => $location->phone,
            'image_url' => $this->viewUrl($location->image_url),
            'status' => $location->status,
            'sort_order' => (int) $location->sort_order,
            'category' => $this->categoryOf($location),
            'media' => $media->get((string) $location->id, collect())->map(fn ($item) => [
                'id' => (int) $item->id,
                'type' => $item->type,
                'type_label' => $this->mediaTypeLabel($item->type),
                'url' => $this->viewUrl($item->url),
            ])->values(),
            'created_at' => $this->iso($location->created_at),
        ];
    }
}
