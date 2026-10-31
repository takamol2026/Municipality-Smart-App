<?php

namespace App\Http\Controllers\Api;

use App\Enums\SuggestionStatus;
use App\Http\Requests\SuggestionStoreValidation;
use App\Models\Suggestion;
use App\Support\StoredImage;
use Illuminate\Http\JsonResponse;

class SuggestionController extends ApiController
{
    public function store(SuggestionStoreValidation $request): JsonResponse
    {
        $validated = $request->validated();
        $validated['status'] = SuggestionStatus::Pending;

        if ($request->hasFile('image')) {
            $validated['image'] = StoredImage::store($request->file('image'), 'suggestions');
        }

        $suggestion = Suggestion::query()->create($validated);
        $suggestion->load('district');

        return response()->json([
            'message' => __('suggestions.saved'),
            'data' => [
                'id' => $suggestion->id,
                'title' => $suggestion->title,
                'description' => $suggestion->description,
                'image_url' => $this->fileUrl($suggestion->image),
                'latitude' => $suggestion->latitude,
                'longitude' => $suggestion->longitude,
                'full_name' => $suggestion->full_name,
                'phone' => $suggestion->phone,
                'district' => $suggestion->district ? [
                    'id' => $suggestion->district->id,
                    'name' => $suggestion->district->name,
                ] : null,
                'status' => $suggestion->status->value,
                'status_label' => $suggestion->status->label(),
                'created_at' => $suggestion->created_at?->toIso8601String(),
            ],
        ], 201);
    }
}
