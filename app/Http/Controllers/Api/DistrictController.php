<?php

namespace App\Http\Controllers\Api;

use App\Enums\RecordStatus;
use App\Models\District;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DistrictController extends ApiController
{
    public function index(Request $request): JsonResponse
    {
        $query = District::query()
            ->with('files')
            ->where('status', RecordStatus::Active);

        $this->applySearch($query, $request, 'name');

        $districts = $query
            ->orderBy('sort_order')
            ->latest('id')
            ->paginate($this->perPage($request))
            ->withQueryString();

        return $this->paginated($districts, fn (District $district) => $this->payload($district));
    }

    public function show(int $district): JsonResponse
    {
        $district = District::query()
            ->with('files')
            ->where('status', RecordStatus::Active)
            ->findOrFail($district);

        return response()->json([
            'data' => $this->payload($district),
        ]);
    }

    private function payload(District $district): array
    {
        return [
            'id' => $district->id,
            'name' => $district->name,
            'lang' => $this->enumValue($district->lang),
            'lang_label' => $district->lang?->label(),
            'number' => $district->number,
            'slug' => $district->slug,
            'description' => $district->description,
            'address' => $district->address,
            'latitude' => $district->latitude,
            'longitude' => $district->longitude,
            'phone' => $district->phone,
            'email' => $district->email,
            'image_url' => $this->fileUrl($district->image),
            'status' => $this->enumValue($district->status),
            'sort_order' => $district->sort_order,
            'files' => $district->files->map(fn ($file) => [
                'id' => $file->id,
                'url' => $this->fileUrl($file->location),
            ])->values(),
            'created_at' => $district->created_at?->toIso8601String(),
        ];
    }
}
