<?php

namespace App\Http\Controllers\Api;

use App\Enums\RecordStatus;
use App\Models\Announcement;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AnnouncementController extends ApiController
{
    public function index(Request $request): JsonResponse
    {
        $query = Announcement::query()->with('category');
        $this->published($query);
        $this->applySearch($query, $request, 'title');

        if ($request->filled('category_id')) {
            $query->where('announcement_category_id', $request->integer('category_id'));
        }

        $announcements = $query
            ->orderBy('sort_order')
            ->latest('id')
            ->paginate($this->perPage($request))
            ->withQueryString();

        return $this->paginated($announcements, fn (Announcement $announcement) => $this->payload($announcement));
    }

    public function show(int $announcement): JsonResponse
    {
        $query = Announcement::query()->with('category');
        $this->published($query);

        $announcement = $query->findOrFail($announcement);

        return response()->json([
            'data' => $this->payload($announcement),
        ]);
    }

    private function published(Builder $query): void
    {
        $query
            ->where('status', RecordStatus::Active)
            ->where(function (Builder $query) {
                $query->whereNull('publish_date')->orWhereDate('publish_date', '<=', now());
            })
            ->where(function (Builder $query) {
                $query->whereNull('expire_date')->orWhereDate('expire_date', '>=', now());
            });
    }

    private function payload(Announcement $announcement): array
    {
        return [
            'id' => $announcement->id,
            'title' => $announcement->title,
            'lang' => $this->enumValue($announcement->lang),
            'lang_label' => $announcement->lang?->label(),
            'slug' => $announcement->slug,
            'short_description' => $announcement->short_description,
            'content' => $announcement->content,
            'image_url' => $this->fileUrl($announcement->image),
            'attachment_url' => $this->fileUrl($announcement->attachment),
            'publish_date' => $this->date($announcement->publish_date),
            'expire_date' => $this->date($announcement->expire_date),
            'status' => $this->enumValue($announcement->status),
            'sort_order' => $announcement->sort_order,
            'category' => $announcement->category ? [
                'id' => $announcement->category->id,
                'name' => $announcement->category->name,
                'slug' => $announcement->category->slug,
            ] : null,
            'created_at' => $announcement->created_at?->toIso8601String(),
        ];
    }
}
