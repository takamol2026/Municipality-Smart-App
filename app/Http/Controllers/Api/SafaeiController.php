<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SafaeiController extends ApiController
{
    public function index(Request $request): JsonResponse
    {
        $query = $this->view('vw_safaei');

        if ($request->filled('search')) {
            $query->where('file_url', 'like', '%'.$request->string('search').'%');
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->integer('category_id'));
        }

        $files = $query
            ->latest('id')
            ->paginate($this->perPage($request))
            ->withQueryString();

        return $this->paginated($files, fn (object $file) => $this->payload($file));
    }

    public function show(int $file): JsonResponse
    {
        return response()->json([
            'data' => $this->payload($this->findView('vw_safaei', $file)),
        ]);
    }

    private function payload(object $file): array
    {
        return [
            'id' => (int) $file->id,
            'file_name' => $file->file_name,
            'file_url' => $this->viewUrl($file->file_url),
            'is_image' => (int) $file->is_image === 1,
            'safaei' => $file->safaei_id === null ? null : [
                'id' => (int) $file->safaei_id,
                'title' => $file->safaei_title,
                'category' => $file->category_id === null ? null : [
                    'id' => (int) $file->category_id,
                    'name' => $file->category_name,
                ],
            ],
            'created_at' => $this->iso($file->created_at),
        ];
    }
}
