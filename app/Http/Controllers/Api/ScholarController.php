<?php

namespace App\Http\Controllers\Api;

use App\Models\Scholar;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ScholarController extends ApiController
{
    public function index(Request $request): JsonResponse
    {
        $query = $this->view('vw_scholars');
        $this->applySearch($query, $request, 'name');

        $scholars = $query
            ->orderBy('sort_order')
            ->latest('id')
            ->paginate($this->perPage($request))
            ->withQueryString();

        return $this->paginated($scholars, fn (object $scholar) => $this->payload($scholar));
    }

    public function show(int $scholar): JsonResponse
    {
        return response()->json([
            'data' => $this->payload($this->findView('vw_scholars', $scholar)),
        ]);
    }

    private function payload(object $scholar): array
    {
        return [
            'id' => (int) $scholar->id,
            'name' => $scholar->name,
            'lang' => $scholar->lang,
            'lang_label' => $this->langLabel($scholar->lang),
            'slug' => $scholar->slug,
            'short_bio' => $scholar->short_bio,
            'biography' => $scholar->biography,
            'birth_date' => Scholar::toJalaliDate($scholar->birth_date),
            'death_date' => Scholar::toJalaliDate($scholar->death_date),
            'education' => $scholar->education,
            'works' => $scholar->works,
            'image_url' => $this->viewUrl($scholar->image_url),
            'status' => $scholar->status,
            'sort_order' => (int) $scholar->sort_order,
            'created_at' => $this->iso($scholar->created_at),
        ];
    }
}
