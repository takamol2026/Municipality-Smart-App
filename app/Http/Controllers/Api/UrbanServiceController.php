<?php

namespace App\Http\Controllers\Api;

use App\Enums\RecordStatus;
use App\Models\UrbanService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UrbanServiceController extends ApiController
{
    public function index(Request $request): JsonResponse
    {
        $query = UrbanService::query()
            ->with('category')
            ->where('status', RecordStatus::Active);

        $this->applySearch($query, $request, 'name');

        if ($request->filled('category_id')) {
            $query->where('urban_service_category_id', $request->integer('category_id'));
        }

        $services = $query
            ->orderBy('sort_order')
            ->latest('id')
            ->paginate($this->perPage($request))
            ->withQueryString();

        return $this->paginated($services, fn (UrbanService $service) => $this->payload($service));
    }

    public function show(int $service): JsonResponse
    {
        $service = UrbanService::query()
            ->with('category')
            ->where('status', RecordStatus::Active)
            ->findOrFail($service);

        return response()->json([
            'data' => $this->payload($service),
        ]);
    }

    private function payload(UrbanService $service): array
    {
        return [
            'id' => $service->id,
            'name' => $service->name,
            'lang' => $this->enumValue($service->lang),
            'lang_label' => $service->lang?->label(),
            'slug' => $service->slug,
            'short_description' => $service->short_description,
            'description' => $service->description,
            'status' => $this->enumValue($service->status),
            'sort_order' => $service->sort_order,
            'category' => $service->category ? [
                'id' => $service->category->id,
                'name' => $service->category->name,
                'slug' => $service->category->slug,
            ] : null,
            'created_at' => $service->created_at?->toIso8601String(),
        ];
    }
}
