<?php

namespace App\Http\Controllers\Api;

use App\Enums\ComplaintStatus;
use App\Http\Requests\ComplaintStoreValidation;
use App\Models\Complaint;
use Illuminate\Http\JsonResponse;

class ComplaintController extends ApiController
{
    public function store(ComplaintStoreValidation $request): JsonResponse
    {
        $complaint = Complaint::query()->create([
            'title' => $request->validated('title'),
            'description' => $request->validated('description'),
            'status' => ComplaintStatus::Pending,
        ]);

        return response()->json([
            'message' => __('complaints.saved'),
            'data' => [
                'id' => $complaint->id,
                'title' => $complaint->title,
                'description' => $complaint->description,
                'status' => $complaint->status->value,
                'status_label' => $complaint->status->label(),
                'created_at' => $complaint->created_at?->toIso8601String(),
            ],
        ], 201);
    }
}
