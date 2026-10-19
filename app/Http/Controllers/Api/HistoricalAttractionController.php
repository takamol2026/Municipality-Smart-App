<?php

namespace App\Http\Controllers\Api;

use App\Enums\RecordStatus;
use App\Models\HistoricalAttraction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HistoricalAttractionController extends ApiController
{
    public function index(Request $request): JsonResponse
    {
        $query = HistoricalAttraction::query()
            ->with('category')
            ->where('status', RecordStatus::Active);

        $this->applySearch($query, $request, 'name');

        if ($request->filled('category_id')) {
            $query->where('historical_attraction_category_id', $request->integer('category_id'));
        }

        $attractions = $query
            ->orderBy('sort_order')
            ->latest('id')
            ->paginate($this->perPage($request))
            ->withQueryString();

        return $this->paginated($attractions, fn (HistoricalAttraction $attraction) => $this->payload($attraction));
    }

    public function show(int $attraction): JsonResponse
    {
        $attraction = HistoricalAttraction::query()
            ->with('category')
            ->where('status', RecordStatus::Active)
            ->findOrFail($attraction);

        return response()->json([
            'data' => $this->payload($attraction),
        ]);
    }

    private function payload(HistoricalAttraction $attraction): array
    {
        return [
            'id' => $attraction->id,
            'name' => $attraction->name,
            'lang' => $this->enumValue($attraction->lang),
            'lang_label' => $attraction->lang?->label(),
            'slug' => $attraction->slug,
            'short_description' => $attraction->short_description,
            'description' => $attraction->description,
            'history' => $attraction->history,
            'address' => $attraction->address,
            'image_url' => $this->fileUrl($attraction->image),
            'status' => $this->enumValue($attraction->status),
            'sort_order' => $attraction->sort_order,
            'category' => $attraction->category ? [
                'id' => $attraction->category->id,
                'name' => $attraction->category->name,
                'slug' => $attraction->category->slug,
            ] : null,
            'created_at' => $attraction->created_at?->toIso8601String(),
        ];
    }
}
