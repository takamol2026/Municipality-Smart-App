<?php

namespace App\Http\Controllers\Api;

use App\Enums\ComplaintStatus;
use App\Http\Requests\ComplaintStoreValidation;
use App\Models\Complaint;
use App\Support\StoredImage;
use Illuminate\Http\JsonResponse;

class ComplaintController extends ApiController
{
    public function store(ComplaintStoreValidation $request): JsonResponse
    {
        $validated = $request->validated();
        $validated['status'] = ComplaintStatus::Pending;

        if ($request->hasFile('image')) {
            $validated['image'] = StoredImage::store($request->file('image'), 'complaints');
        }

        $complaint = Complaint::query()->create($validated);
        $complaint->load('district');

        return response()->json([
            'message' => __('complaints.saved'),
            'data' => [
                'id' => $complaint->id,
                'title' => $complaint->title,
                'description' => $complaint->description,
                'image_url' => $this->fileUrl($complaint->image),
                'latitude' => $complaint->latitude,
                'longitude' => $complaint->longitude,
                'full_name' => $complaint->full_name,
                'phone' => $complaint->phone,
                'district' => $complaint->district ? [
                    'id' => $complaint->district->id,
                    'name' => $complaint->district->name,
                ] : null,
                'status' => $complaint->status->value,
                'status_label' => $complaint->status->label(),
                'created_at' => $complaint->created_at?->toIso8601String(),
            ],
        ], 201);
    }
}
