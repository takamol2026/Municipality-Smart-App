<?php

namespace App\Http\Controllers\Api;

use App\Enums\LicenseOnlineServiceType;
use App\Enums\RecordStatus;
use App\Models\LicenseOnlineService;
use App\Models\LicenseOnlineServiceFile;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LicenseOnlineServiceController extends ApiController
{
    public function index(Request $request): JsonResponse
    {
        $query = LicenseOnlineService::query()
            ->with('files')
            ->where('status', RecordStatus::Active);

        $this->applySearch($query, $request, 'name');

        $type = LicenseOnlineServiceType::tryFrom($request->string('type')->toString());

        if ($type !== null) {
            $query->where('type', $type);
        }

        $services = $query
            ->orderBy('sort_order')
            ->latest('id')
            ->paginate($this->perPage($request))
            ->withQueryString();

        return $this->paginated($services, fn (LicenseOnlineService $service) => $this->payload($service));
    }

    public function show(int $licenseOnlineService): JsonResponse
    {
        $service = LicenseOnlineService::query()
            ->with('files')
            ->where('status', RecordStatus::Active)
            ->findOrFail($licenseOnlineService);

        return response()->json([
            'data' => $this->payload($service),
        ]);
    }

    private function payload(LicenseOnlineService $service): array
    {
        return [
            'id' => $service->id,
            'type' => $this->enumValue($service->type),
            'type_label' => $service->type?->label(),
            'name' => $service->name,
            'lang' => $this->enumValue($service->lang),
            'lang_label' => $service->lang?->label(),
            'description' => $service->description,
            'image_url' => $this->fileUrl($service->image),
            'status' => $this->enumValue($service->status),
            'sort_order' => $service->sort_order,
            'files' => $service->files->map(fn (LicenseOnlineServiceFile $file) => [
                'id' => $file->id,
                'file_name' => $file->file_name,
                'file_type' => $file->file_type,
                'file_size' => $file->file_size,
                'url' => $this->fileUrl($file->file_path),
            ])->values(),
            'created_at' => $service->created_at?->toIso8601String(),
        ];
    }
}
