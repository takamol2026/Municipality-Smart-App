<?php

namespace App\Http\Controllers\Api;

use App\Enums\SocialNetwork;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SocialLinkController extends ApiController
{
    public function index(Request $request): JsonResponse
    {
        $links = $this->view('vw_social_links')
            ->orderBy('sort_order')
            ->latest('id')
            ->paginate($this->perPage($request))
            ->withQueryString();

        return $this->paginated($links, fn (object $link) => $this->payload($link));
    }

    private function payload(object $link): array
    {
        return [
            'id' => (int) $link->id,
            'network' => $link->network,
            'network_label' => SocialNetwork::tryFrom((string) $link->network)?->label(),
            'url' => $link->url,
            'status' => $link->status,
            'sort_order' => (int) $link->sort_order,
        ];
    }
}
