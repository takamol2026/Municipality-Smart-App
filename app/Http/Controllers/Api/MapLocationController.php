<?php

namespace App\Http\Controllers\Api;

use App\Enums\RecordStatus;
use App\Models\MapLocation;
use App\Models\MapMedia;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MapLocationController extends ApiController
{
    public function index(Request $request): JsonResponse
    {
        $query = MapLocation::query()
            ->with(['category', 'media'])
            ->where('status', RecordStatus::Active);

        $this->applySearch($query, $request, 'name');

        if ($request->filled('category_id')) {
            $query->where('map_category_id', $request->integer('category_id'));
        }

        $locations = $query
            ->orderBy('sort_order')
            ->latest('id')
            ->paginate($this->perPage($request))
            ->withQueryString();

        return $this->paginated($locations, fn (MapLocation $location) => $this->payload($location));
    }

    public function show(int $location): JsonResponse
    {
        $location = MapLocation::query()
            ->with(['category', 'media'])
            ->where('status', RecordStatus::Active)
            ->findOrFail($location);

        return response()->json([
            'data' => $this->payload($location),
        ]);
    }

    private function payload(MapLocation $location): array
    {
        return [
            'id' => $location->id,
            'name' => $location->name,
            'lang' => $this->enumValue($location->lang),
            'lang_label' => $location->lang?->label(),
            'slug' => $location->slug,
            'description' => $location->description,
            'address' => $location->address,
            'latitude' => $location->latitude,
            'longitude' => $location->longitude,
            'phone' => $location->phone,
            'image_url' => $this->fileUrl($location->image),
            'status' => $this->enumValue($location->status),
            'sort_order' => $location->sort_order,
            'category' => $location->category ? [
                'id' => $location->category->id,
                'name' => $location->category->name,
                'slug' => $location->category->slug,
            ] : null,
            'media' => $location->media->map(fn (MapMedia $media) => [
                'id' => $media->id,
                'type' => $media->type,
                'type_label' => $media->typeLabel(),
                'url' => $this->fileUrl($media->location),
            ])->values(),
            'created_at' => $location->created_at?->toIso8601String(),
        ];
    }
}
