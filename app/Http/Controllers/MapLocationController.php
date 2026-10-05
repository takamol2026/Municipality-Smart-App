<?php

namespace App\Http\Controllers;

use App\Enums\RecordStatus;
use App\Http\Requests\MapLocationStoreValidation;
use App\Http\Requests\MapLocationUpdateValidation;
use App\Models\MapCategory;
use App\Models\MapLocation;
use App\Models\MapMedia;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class MapLocationController extends Controller
{
    public function index(Request $request): View
    {
        $locations = MapLocation::query()
            ->with(['user', 'category', 'media'])
            ->when($request->filled('name'), function ($query) use ($request) {
                $query->where('name', 'like', '%'.$request->string('name').'%');
            })
            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where('status', $request->string('status'));
            })
            ->latest('id')
            ->paginate(15)
            ->withQueryString();

        return view('map-locations.index', compact('locations'));
    }

    public function create(): View
    {
        return view('map-locations.create', [
            'categories' => $this->categories(),
        ]);
    }

    public function store(MapLocationStoreValidation $request): RedirectResponse
    {
        $validated = $request->validated();
        unset($validated['media']);

        $validated['slug'] = $validated['slug'] ?: Str::slug($validated['name']);
        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['status'] = RecordStatus::from($validated['status']);
        $validated['user_id'] = $request->user()->id;

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('map-locations', 'public');
        }

        $location = MapLocation::create($validated);
        $this->storeNewMedia($location, $request);

        return redirect()
            ->route('map-locations.index')
            ->with('success', 'مکان با موفقیت ذخیره شد.');
    }

    public function edit(MapLocation $mapLocation): View
    {
        $mapLocation->load('media');

        return view('map-locations.edit', [
            'location' => $mapLocation,
            'categories' => $this->categories(),
        ]);
    }

    public function update(MapLocationUpdateValidation $request, MapLocation $mapLocation): RedirectResponse
    {
        $validated = $request->validated();
        unset($validated['media'], $validated['existing_media']);

        $validated['slug'] = $validated['slug'] ?: Str::slug($validated['name']);
        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['status'] = RecordStatus::from($validated['status']);

        if ($request->hasFile('image')) {
            $this->deleteFile($mapLocation->image);
            $validated['image'] = $request->file('image')->store('map-locations', 'public');
        }

        $mapLocation->update($validated);
        $this->updateExistingMedia($mapLocation, $request);
        $this->storeNewMedia($mapLocation, $request);

        return redirect()
            ->route('map-locations.index')
            ->with('success', 'مکان با موفقیت ویرایش شد.');
    }

    public function downloadImage(MapLocation $mapLocation): StreamedResponse
    {
        abort_unless($mapLocation->image && Storage::disk('public')->exists($mapLocation->image), 404);

        return Storage::disk('public')->download($mapLocation->image, basename($mapLocation->image));
    }

    public function downloadMedia(MapLocation $mapLocation, MapMedia $mapMedia): StreamedResponse
    {
        abort_unless($mapMedia->map_location_id === $mapLocation->id && $mapMedia->location && Storage::disk('public')->exists($mapMedia->location), 404);

        return Storage::disk('public')->download($mapMedia->location, basename($mapMedia->location));
    }

    public function destroyMedia(MapLocation $mapLocation, MapMedia $mapMedia): RedirectResponse
    {
        abort_unless($mapMedia->map_location_id === $mapLocation->id, 404);

        $this->deleteFile($mapMedia->location);
        $mapMedia->delete();

        return redirect()
            ->route('map-locations.edit', $mapLocation)
            ->with('success', 'رسانه با موفقیت حذف شد.');
    }

    public function destroy(MapLocation $mapLocation): RedirectResponse
    {
        foreach ($mapLocation->media as $media) {
            $this->deleteFile($media->location);
            $media->delete();
        }

        $this->deleteFile($mapLocation->image);
        $mapLocation->delete();

        return redirect()
            ->route('map-locations.index')
            ->with('success', 'مکان با موفقیت حذف شد.');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection<int, MapCategory>
     */
    private function categories()
    {
        return MapCategory::query()
            ->orderBy('name')
            ->get();
    }

    private function storeNewMedia(MapLocation $mapLocation, Request $request): void
    {
        foreach ($request->input('media') ?? [] as $index => $item) {
            $file = $request->file("media.$index.file");

            if (! $file instanceof UploadedFile) {
                continue;
            }

            $mapLocation->media()->create([
                'type' => filled($item['type'] ?? null) ? $item['type'] : $this->guessMediaType($file),
                'location' => $file->store('map-media', 'public'),
                'user_id' => $request->user()->id,
            ]);
        }
    }

    private function updateExistingMedia(MapLocation $mapLocation, Request $request): void
    {
        foreach ($request->input('existing_media') ?? [] as $id => $item) {
            $media = $mapLocation->media()->whereKey($id)->first();

            if (! $media) {
                continue;
            }

            $data = [
                'type' => filled($item['type'] ?? null) ? $item['type'] : $media->type,
            ];

            $file = $request->file("existing_media.$id.file");
            if ($file instanceof UploadedFile) {
                $this->deleteFile($media->location);
                $data['location'] = $file->store('map-media', 'public');
                $data['type'] = filled($item['type'] ?? null) ? $item['type'] : $this->guessMediaType($file);
            }

            $media->update($data);
        }
    }

    private function guessMediaType(UploadedFile $file): string
    {
        $mime = (string) $file->getMimeType();

        if (str_starts_with($mime, 'image/')) {
            return 'image';
        }

        if (str_starts_with($mime, 'video/')) {
            return 'video';
        }

        return 'document';
    }

    private function deleteFile(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
