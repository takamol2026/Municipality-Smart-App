<?php

namespace App\Http\Controllers;

use App\Enums\Language;
use App\Enums\LicenseOnlineServiceType;
use App\Enums\RecordStatus;
use App\Http\Requests\LicenseOnlineServiceStoreValidation;
use App\Http\Requests\LicenseOnlineServiceUpdateValidation;
use App\Models\LicenseOnlineService;
use App\Models\LicenseOnlineServiceFile;
use App\Support\StoredImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Throwable;

class LicenseOnlineServiceController extends Controller
{
    public function index(Request $request): View
    {
        $type = LicenseOnlineServiceType::tryFrom($request->string('type')->toString());

        $services = LicenseOnlineService::query()
            ->with(['user', 'files'])
            ->when($request->filled('name'), function ($query) use ($request) {
                $query->where('name', 'like', '%'.$request->string('name').'%');
            })
            ->when($type !== null, function ($query) use ($type) {
                $query->where('type', $type);
            })
            ->when($request->filled('lang'), function ($query) use ($request) {
                $query->where('lang', $request->string('lang'));
            })
            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where('status', $request->string('status'));
            })
            ->latest('id')
            ->paginate(15)
            ->withQueryString();

        return view('license-online-services.index', compact('services'));
    }

    public function create(): View
    {
        return view('license-online-services.create');
    }

    public function store(LicenseOnlineServiceStoreValidation $request): RedirectResponse
    {
        $validated = $request->validated();
        unset($validated['attachments']);

        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['type'] = LicenseOnlineServiceType::from($validated['type']);
        $validated['lang'] = Language::from($validated['lang']);
        $validated['status'] = RecordStatus::from($validated['status']);
        $validated['user_id'] = $request->user()->id;

        $storedPaths = [];

        try {
            if ($request->hasFile('image')) {
                $validated['image'] = $this->storeUpload($request->file('image'), 'license-online-services', 'image');
                $storedPaths[] = $validated['image'];
            }

            DB::transaction(function () use ($validated, $request, &$storedPaths) {
                $service = LicenseOnlineService::create($validated);
                $this->storeAttachments($service, $request, $storedPaths);
            });
        } catch (Throwable $exception) {
            $this->deleteStoredPaths($storedPaths);

            throw $exception;
        }

        return redirect()
            ->route('license-online-services.index')
            ->with('success', __('license_online_services.saved'));
    }

    public function edit(LicenseOnlineService $licenseOnlineService): View
    {
        $licenseOnlineService->load('files');

        return view('license-online-services.edit', [
            'service' => $licenseOnlineService,
        ]);
    }

    public function update(LicenseOnlineServiceUpdateValidation $request, LicenseOnlineService $licenseOnlineService): RedirectResponse
    {
        $validated = $request->validated();
        unset($validated['attachments']);

        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['type'] = LicenseOnlineServiceType::from($validated['type']);
        $validated['lang'] = Language::from($validated['lang']);
        $validated['status'] = RecordStatus::from($validated['status']);

        $storedPaths = [];
        $previousImage = null;

        try {
            if ($request->hasFile('image')) {
                $validated['image'] = $this->storeUpload($request->file('image'), 'license-online-services', 'image');
                $storedPaths[] = $validated['image'];
                $previousImage = $licenseOnlineService->image;
            }

            DB::transaction(function () use ($licenseOnlineService, $validated, $request, &$storedPaths) {
                $licenseOnlineService->update($validated);
                $this->storeAttachments($licenseOnlineService, $request, $storedPaths);
            });
        } catch (Throwable $exception) {
            $this->deleteStoredPaths($storedPaths);

            throw $exception;
        }

        if (is_string($previousImage) && $previousImage !== '' && $previousImage !== ($validated['image'] ?? null)) {
            $this->deleteStored($previousImage);
        }

        return redirect()
            ->route('license-online-services.index')
            ->with('success', __('license_online_services.updated'));
    }

    public function downloadImage(LicenseOnlineService $licenseOnlineService): StreamedResponse
    {
        abort_unless($this->isStored($licenseOnlineService->image), 404);

        return Storage::disk('public')->download($licenseOnlineService->image, basename($licenseOnlineService->image));
    }

    public function downloadFile(LicenseOnlineService $licenseOnlineService, LicenseOnlineServiceFile $file): StreamedResponse
    {
        abort_unless($file->license_online_service_id === $licenseOnlineService->id && $this->isStored($file->file_path), 404);

        return Storage::disk('public')->download($file->file_path, $this->downloadName($file));
    }

    public function destroyFile(LicenseOnlineService $licenseOnlineService, LicenseOnlineServiceFile $file): RedirectResponse
    {
        abort_unless($file->license_online_service_id === $licenseOnlineService->id, 404);

        $this->deleteStored($file->file_path);
        $file->delete();

        return redirect()
            ->route('license-online-services.edit', $licenseOnlineService)
            ->with('success', __('license_online_services.file_deleted'));
    }

    public function destroy(LicenseOnlineService $licenseOnlineService): RedirectResponse
    {
        $licenseOnlineService->load('files');

        foreach ($licenseOnlineService->files as $file) {
            $this->deleteStored($file->file_path);
            $file->delete();
        }

        $this->deleteStored($licenseOnlineService->image);
        $licenseOnlineService->delete();

        return redirect()
            ->route('license-online-services.index')
            ->with('success', __('license_online_services.deleted'));
    }

    /**
     * @param  array<int, string>  $storedPaths
     */
    private function storeAttachments(LicenseOnlineService $service, Request $request, array &$storedPaths): void
    {
        foreach ($request->file('attachments', []) as $file) {
            if (! $file instanceof UploadedFile) {
                continue;
            }

            $path = $this->storeUpload($file, 'license-online-services/files', 'attachments');
            $storedPaths[] = $path;

            $service->files()->create([
                'file_name' => $this->originalName($file),
                'file_path' => $path,
                'file_type' => Storage::disk('public')->mimeType($path) ?: $file->getClientMimeType(),
                'file_size' => Storage::disk('public')->size($path),
            ]);
        }
    }

    private function storeUpload(UploadedFile $file, string $directory, string $errorField): string
    {
        $path = StoredImage::store($file, $directory);

        if (! is_string($path) || $path === '') {
            throw ValidationException::withMessages([
                $errorField => __('license_online_services.upload_failed'),
            ]);
        }

        return $path;
    }

    private function originalName(UploadedFile $file): string
    {
        $name = basename(str_replace('\\', '/', $file->getClientOriginalName()));
        $name = trim((string) preg_replace('/[\x00-\x1F\x7F]/u', '', $name));

        if ($name === '' || $name === '.' || $name === '..') {
            $name = 'file';
        }

        return mb_substr($name, 0, 255);
    }

    private function downloadName(LicenseOnlineServiceFile $file): string
    {
        $name = basename(str_replace('\\', '/', (string) $file->file_name));
        $name = trim((string) preg_replace('/[\x00-\x1F\x7F]/u', '', $name));

        if ($name === '' || $name === '.' || $name === '..') {
            return basename((string) $file->file_path);
        }

        return $name;
    }

    /**
     * @param  array<int, string>  $paths
     */
    private function deleteStoredPaths(array $paths): void
    {
        foreach ($paths as $path) {
            $this->deleteStored($path);
        }
    }

    private function deleteStored(?string $path): void
    {
        if (! $this->isStored($path)) {
            return;
        }

        Storage::disk('public')->delete($path);
    }

    private function isStored(?string $path): bool
    {
        return is_string($path)
            && $path !== ''
            && ! str_contains($path, '..')
            && Storage::disk('public')->exists($path);
    }
}
