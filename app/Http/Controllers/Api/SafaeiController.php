<?php

namespace App\Http\Controllers\Api;

use App\Enums\RecordStatus;
use App\Models\Safaei;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SafaeiController extends ApiController
{
    public function index(Request $request): JsonResponse
    {
        $query = Safaei::query()
            ->with('category')
            ->where(function ($query) {
                $query->whereNull('safaei_category_id')
                    ->orWhereHas('category', fn ($category) => $category->where('status', RecordStatus::Active));
            });

        if ($request->filled('search')) {
            $query->where('file_path', 'like', '%'.$request->string('search').'%');
        }

        if ($request->filled('category_id')) {
            $query->where('safaei_category_id', $request->integer('category_id'));
        }

        $files = $query
            ->latest('id')
            ->paginate($this->perPage($request))
            ->withQueryString();

        return $this->paginated($files, fn (Safaei $file) => $this->payload($file));
    }

    public function show(int $file): JsonResponse
    {
        $file = Safaei::query()
            ->with('category')
            ->where(function ($query) {
                $query->whereNull('safaei_category_id')
                    ->orWhereHas('category', fn ($category) => $category->where('status', RecordStatus::Active));
            })
            ->findOrFail($file);

        return response()->json([
            'data' => $this->payload($file),
        ]);
    }

    private function payload(Safaei $file): array
    {
        return [
            'id' => $file->id,
            'file_name' => $file->fileName() === '—' ? null : $file->fileName(),
            'file_url' => $this->fileUrl($file->file_path),
            'is_image' => $file->isImageFile(),
            'category' => $file->category ? [
                'id' => $file->category->id,
                'name' => $file->category->name,
            ] : null,
            'created_at' => $file->created_at?->toIso8601String(),
        ];
    }
}
