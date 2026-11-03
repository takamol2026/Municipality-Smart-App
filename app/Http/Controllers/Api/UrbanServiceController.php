<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UrbanServiceController extends ApiController
{
    public function index(Request $request): JsonResponse
    {
        $query = $this->view('vw_urban_services');
        $this->applySearch($query, $request, 'name');

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->integer('category_id'));
        }

        $services = $query
            ->orderBy('sort_order')
            ->latest('id')
            ->paginate($this->perPage($request))
            ->withQueryString();

        return $this->paginated($services, fn (object $service) => $this->payload($service));
    }

    public function show(int $service): JsonResponse
    {
        return response()->json([
            'data' => $this->payload($this->findView('vw_urban_services', $service)),
        ]);
    }

    private function payload(object $service): array
    {
        return [
            'id' => (int) $service->id,
            'name' => $service->name,
            'lang' => $service->lang,
            'lang_label' => $this->langLabel($service->lang),
            'slug' => $service->slug,
            'short_description' => $service->short_description,
            'description' => $service->description,
            'status' => $service->status,
            'sort_order' => (int) $service->sort_order,
            'category' => $this->categoryOf($service),
            'created_at' => $this->iso($service->created_at),
        ];
    }
}
