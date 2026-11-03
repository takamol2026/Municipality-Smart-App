<?php

namespace App\Http\Controllers\Api;

use App\Enums\LicenseOnlineServiceType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class LicenseOnlineServiceController extends ApiController
{
    public function index(Request $request): JsonResponse
    {
        $query = $this->view('vw_license_online_services');
        $this->applySearch($query, $request, 'name');

        $type = LicenseOnlineServiceType::tryFrom($request->string('type')->toString());

        if ($type !== null) {
            $query->where('type', $type->value);
        }

        $services = $query
            ->orderBy('sort_order')
            ->latest('id')
            ->paginate($this->perPage($request))
            ->withQueryString();

        $files = $this->rowsFor('vw_license_online_service_files', 'license_online_service_id', $services->getCollection()->pluck('id'))
            ->sortBy('id')
            ->groupBy(fn ($file) => (string) $file->license_online_service_id);

        return $this->paginated($services, fn (object $service) => $this->payload($service, $files));
    }

    public function show(int $licenseOnlineService): JsonResponse
    {
        $service = $this->findView('vw_license_online_services', $licenseOnlineService);
        $files = $this->rowsFor('vw_license_online_service_files', 'license_online_service_id', [$service->id])
            ->sortBy('id')
            ->groupBy(fn ($file) => (string) $file->license_online_service_id);

        return response()->json([
            'data' => $this->payload($service, $files),
        ]);
    }

    private function payload(object $service, Collection $files): array
    {
        return [
            'id' => (int) $service->id,
            'type' => $service->type,
            'type_label' => LicenseOnlineServiceType::tryFrom((string) $service->type)?->label(),
            'name' => $service->name,
            'lang' => $service->lang,
            'lang_label' => $this->langLabel($service->lang),
            'description' => $service->description,
            'image_url' => $this->viewUrl($service->image_url),
            'status' => $service->status,
            'sort_order' => (int) $service->sort_order,
            'files' => $files->get((string) $service->id, collect())->map(fn ($file) => [
                'id' => (int) $file->id,
                'file_name' => $file->file_name,
                'file_type' => $file->file_type,
                'file_size' => (int) $file->file_size,
                'url' => $this->viewUrl($file->url),
            ])->values(),
            'created_at' => $this->iso($service->created_at),
        ];
    }
}
