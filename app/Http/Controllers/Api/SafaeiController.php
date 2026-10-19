<?php

namespace App\Http\Controllers\Api;

use App\Enums\RecordStatus;
use App\Models\SafaeiPhoto;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SafaeiController extends ApiController
{
    public function index(Request $request): JsonResponse
    {
        $query = SafaeiPhoto::query()
            ->with('safaei.category')
            ->whereHas('safaei.category', fn ($category) => $category->where('status', RecordStatus::Active));

        if ($request->filled('search')) {
            $query->where('file_path', 'like', '%'.$request->string('search').'%');
        }

        if ($request->filled('category_id')) {
            $query->whereHas('safaei', fn ($safaei) => $safaei->where('safaei_category_id', $request->integer('category_id')));
        }

        $files = $query
            ->latest('id')
            ->paginate($this->perPage($request))
            ->withQueryString();

        return $this->paginated($files, fn (SafaeiPhoto $file) => $this->payload($file));
    }

    public function show(int $file): JsonResponse
    {
        $file = SafaeiPhoto::query()
            ->with('safaei.category')
            ->whereHas('safaei.category', fn ($category) => $category->where('status', RecordStatus::Active))
            ->findOrFail($file);

        return response()->json([
            'data' => $this->payload($file),
        ]);
    }

    private function payload(SafaeiPhoto $file): array
    {
        return [
            'id' => $file->id,
            'file_name' => $file->fileName() === '—' ? null : $file->fileName(),
            'file_url' => $this->fileUrl($file->file_path),
            'is_image' => $file->isImageFile(),
            'safaei' => $file->safaei ? [
                'id' => $file->safaei->id,
                'title' => $file->safaei->title,
                'category' => $file->safaei->category ? [
                    'id' => $file->safaei->category->id,
                    'name' => $file->safaei->category->name,
                ] : null,
            ] : null,
            'created_at' => $file->created_at?->toIso8601String(),
        ];
    }
}
