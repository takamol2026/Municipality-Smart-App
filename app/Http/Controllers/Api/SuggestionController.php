<?php

namespace App\Http\Controllers\Api;

use App\Enums\SuggestionStatus;
use App\Http\Requests\SuggestionStoreValidation;
use App\Models\Suggestion;
use Illuminate\Http\JsonResponse;

class SuggestionController extends ApiController
{
    public function store(SuggestionStoreValidation $request): JsonResponse
    {
        $suggestion = Suggestion::query()->create([
            'title' => $request->validated('title'),
            'description' => $request->validated('description'),
            'status' => SuggestionStatus::Pending,
        ]);

        return response()->json([
            'message' => __('suggestions.saved'),
            'data' => [
                'id' => $suggestion->id,
                'title' => $suggestion->title,
                'description' => $suggestion->description,
                'status' => $suggestion->status->value,
                'status_label' => $suggestion->status->label(),
                'created_at' => $suggestion->created_at?->toIso8601String(),
            ],
        ], 201);
    }
}
