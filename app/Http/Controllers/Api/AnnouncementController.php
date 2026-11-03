<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AnnouncementController extends ApiController
{
    public function index(Request $request): JsonResponse
    {
        $query = $this->view('vw_announcements');
        $this->applySearch($query, $request, 'title');

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->integer('category_id'));
        }

        $announcements = $query
            ->orderBy('sort_order')
            ->latest('id')
            ->paginate($this->perPage($request))
            ->withQueryString();

        return $this->paginated($announcements, fn (object $announcement) => $this->payload($announcement));
    }

    public function show(int $announcement): JsonResponse
    {
        return response()->json([
            'data' => $this->payload($this->findView('vw_announcements', $announcement)),
        ]);
    }

    private function payload(object $announcement): array
    {
        return [
            'id' => (int) $announcement->id,
            'title' => $announcement->title,
            'lang' => $announcement->lang,
            'lang_label' => $this->langLabel($announcement->lang),
            'slug' => $announcement->slug,
            'short_description' => $announcement->short_description,
            'content' => $announcement->content,
            'image_url' => $this->viewUrl($announcement->image_url),
            'attachment_url' => $this->viewUrl($announcement->attachment_url),
            'publish_date' => $this->day($announcement->publish_date),
            'expire_date' => $this->day($announcement->expire_date),
            'status' => $announcement->status,
            'sort_order' => (int) $announcement->sort_order,
            'category' => $this->categoryOf($announcement),
            'created_at' => $this->iso($announcement->created_at),
        ];
    }
}
