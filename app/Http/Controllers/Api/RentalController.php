<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RentalController extends ApiController
{
    public function index(Request $request): JsonResponse
    {
        $query = $this->view('vw_rentals');
        $this->applySearch($query, $request, 'name');

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->integer('category_id'));
        }

        $rentals = $query
            ->orderBy('sort_order')
            ->latest('id')
            ->paginate($this->perPage($request))
            ->withQueryString();

        return $this->paginated($rentals, fn (object $rental) => $this->payload($rental));
    }

    public function show(int $rental): JsonResponse
    {
        return response()->json([
            'data' => $this->payload($this->findView('vw_rentals', $rental)),
        ]);
    }

    private function payload(object $rental): array
    {
        return [
            'id' => (int) $rental->id,
            'name' => $rental->name,
            'lang' => $rental->lang,
            'lang_label' => $this->langLabel($rental->lang),
            'slug' => $rental->slug,
            'description' => $rental->description,
            'address' => $rental->address,
            'latitude' => $rental->latitude,
            'longitude' => $rental->longitude,
            'rental_price' => $rental->rental_price === null ? null : (int) $rental->rental_price,
            'rental_period' => $rental->rental_period === null ? null : (int) $rental->rental_period,
            'image_url' => $this->viewUrl($rental->image_url),
            'status' => $rental->status,
            'sort_order' => (int) $rental->sort_order,
            'category' => $this->categoryOf($rental),
            'created_at' => $this->iso($rental->created_at),
        ];
    }
}
