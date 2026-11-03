<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class DistrictController extends ApiController
{
    public function index(Request $request): JsonResponse
    {
        $query = $this->view('vw_districts');
        $this->applySearch($query, $request, 'name');

        $districts = $query
            ->orderBy('sort_order')
            ->latest('id')
            ->paginate($this->perPage($request))
            ->withQueryString();

        $files = $this->rowsFor('vw_district_files', 'district_id', $districts->getCollection()->pluck('id'))
            ->sortBy('id')
            ->groupBy(fn ($file) => (string) $file->district_id);

        return $this->paginated($districts, fn (object $district) => $this->payload($district, $files));
    }

    public function show(int $district): JsonResponse
    {
        $district = $this->findView('vw_districts', $district);
        $files = $this->rowsFor('vw_district_files', 'district_id', [$district->id])
            ->sortBy('id')
            ->groupBy(fn ($file) => (string) $file->district_id);

        return response()->json([
            'data' => $this->payload($district, $files),
        ]);
    }

    private function payload(object $district, Collection $files): array
    {
        return [
            'id' => (int) $district->id,
            'name' => $district->name,
            'lang' => $district->lang,
            'lang_label' => $this->langLabel($district->lang),
            'number' => $district->number,
            'slug' => $district->slug,
            'description' => $district->description,
            'address' => $district->address,
            'latitude' => $district->latitude,
            'longitude' => $district->longitude,
            'phone' => $district->phone,
            'email' => $district->email,
            'image_url' => $this->viewUrl($district->image_url),
            'status' => $district->status,
            'sort_order' => (int) $district->sort_order,
            'files' => $files->get((string) $district->id, collect())->map(fn ($file) => [
                'id' => (int) $file->id,
                'url' => $this->viewUrl($file->url),
            ])->values(),
            'created_at' => $this->iso($district->created_at),
        ];
    }
}
