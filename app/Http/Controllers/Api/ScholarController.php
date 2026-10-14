<?php

namespace App\Http\Controllers\Api;

use App\Enums\RecordStatus;
use App\Models\Scholar;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ScholarController extends ApiController
{
    public function index(Request $request): JsonResponse
    {
        $query = Scholar::query()->where('status', RecordStatus::Active);

        $this->applySearch($query, $request, 'name');

        $scholars = $query
            ->orderBy('sort_order')
            ->latest('id')
            ->paginate($this->perPage($request))
            ->withQueryString();

        return $this->paginated($scholars, fn (Scholar $scholar) => $this->payload($scholar));
    }

    public function show(int $scholar): JsonResponse
    {
        $scholar = Scholar::query()
            ->where('status', RecordStatus::Active)
            ->findOrFail($scholar);

        return response()->json([
            'data' => $this->payload($scholar),
        ]);
    }

    private function payload(Scholar $scholar): array
    {
        return [
            'id' => $scholar->id,
            'name' => $scholar->name,
            'slug' => $scholar->slug,
            'short_bio' => $scholar->short_bio,
            'biography' => $scholar->biography,
            'birth_date' => $this->date($scholar->birth_date),
            'death_date' => $this->date($scholar->death_date),
            'education' => $scholar->education,
            'works' => $scholar->works,
            'image_url' => $this->fileUrl($scholar->image),
            'status' => $this->enumValue($scholar->status),
            'sort_order' => $scholar->sort_order,
            'created_at' => $scholar->created_at?->toIso8601String(),
        ];
    }
}
