<?php

namespace App\Http\Controllers\Api;

use App\Enums\RecordStatus;
use App\Models\Rental;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RentalController extends ApiController
{
    public function index(Request $request): JsonResponse
    {
        $query = Rental::query()
            ->with('category')
            ->where('status', RecordStatus::Active);

        $this->applySearch($query, $request, 'name');

        if ($request->filled('category_id')) {
            $query->where('rental_category_id', $request->integer('category_id'));
        }

        $rentals = $query
            ->orderBy('sort_order')
            ->latest('id')
            ->paginate($this->perPage($request))
            ->withQueryString();

        return $this->paginated($rentals, fn (Rental $rental) => $this->payload($rental));
    }

    public function show(int $rental): JsonResponse
    {
        $rental = Rental::query()
            ->with('category')
            ->where('status', RecordStatus::Active)
            ->findOrFail($rental);

        return response()->json([
            'data' => $this->payload($rental),
        ]);
    }

    private function payload(Rental $rental): array
    {
        return [
            'id' => $rental->id,
            'name' => $rental->name,
            'slug' => $rental->slug,
            'description' => $rental->description,
            'address' => $rental->address,
            'rental_price' => $rental->rental_price,
            'rental_period' => $rental->rental_period,
            'image_url' => $this->fileUrl($rental->image),
            'status' => $this->enumValue($rental->status),
            'sort_order' => $rental->sort_order,
            'category' => $rental->category ? [
                'id' => $rental->category->id,
                'name' => $rental->category->name,
                'slug' => $rental->category->slug,
            ] : null,
            'created_at' => $rental->created_at?->toIso8601String(),
        ];
    }
}
