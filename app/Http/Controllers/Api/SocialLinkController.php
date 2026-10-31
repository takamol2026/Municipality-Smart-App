<?php

namespace App\Http\Controllers\Api;

use App\Enums\RecordStatus;
use App\Models\SocialLink;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SocialLinkController extends ApiController
{
    public function index(Request $request): JsonResponse
    {
        $links = SocialLink::query()
            ->where('status', RecordStatus::Active)
            ->orderBy('sort_order')
            ->latest('id')
            ->paginate($this->perPage($request))
            ->withQueryString();

        return $this->paginated($links, fn (SocialLink $link) => $this->payload($link));
    }

    private function payload(SocialLink $link): array
    {
        return [
            'id' => $link->id,
            'network' => $this->enumValue($link->network),
            'network_label' => $link->network?->label(),
            'url' => $link->url,
            'status' => $this->enumValue($link->status),
            'sort_order' => $link->sort_order,
        ];
    }
}
