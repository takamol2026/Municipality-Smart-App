<?php

namespace App\Http\Controllers;

use App\Enums\RecordStatus;
use App\Http\Requests\DistrictStoreValidation;
use App\Http\Requests\DistrictUpdateValidation;
use App\Models\District;
use App\Models\DistrictFile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DistrictController extends Controller
{
    public function index(Request $request): View
    {
        $districts = District::query()
            ->with(['user', 'files'])
            ->when($request->filled('name'), function ($query) use ($request) {
                $query->where('name', 'like', '%'.$request->string('name').'%');
            })
            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where('status', $request->string('status'));
            })
            ->latest('id')
            ->paginate(15)
            ->withQueryString();

        return view('districts.index', compact('districts'));
    }

    public function create(): View
    {
        return view('districts.create');
    }

    public function store(DistrictStoreValidation $request): RedirectResponse
    {
        $validated = $request->validated();

        $validated['slug'] = $validated['slug'] ?: Str::slug($validated['name']);
        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['status'] = RecordStatus::from($validated['status']);
        $validated['user_id'] = $request->user()->id;

        unset($validated['images']);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('districts', 'public');
        }

        $district = District::create($validated);
        $this->storeDistrictImages($district, $request);

        return redirect()
            ->route('districts.index')
            ->with('success', __('districts.saved'));
    }

    public function edit(District $district): View
    {
        $district->load('files');

        return view('districts.edit', compact('district'));
    }

    public function update(DistrictUpdateValidation $request, District $district): RedirectResponse
    {
        $validated = $request->validated();

        $validated['slug'] = $validated['slug'] ?: Str::slug($validated['name']);
        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['status'] = RecordStatus::from($validated['status']);

        unset($validated['images']);

        if ($request->hasFile('image')) {
            $this->deleteDistrictImage($district->image);
            $validated['image'] = $request->file('image')->store('districts', 'public');
        }

        $district->update($validated);
        $this->storeDistrictImages($district, $request);

        return redirect()
            ->route('districts.index')
            ->with('success', __('districts.updated'));
    }

    public function downloadImage(District $district): StreamedResponse
    {
        abort_unless($district->image && Storage::disk('public')->exists($district->image), 404);

        return Storage::disk('public')->download($district->image, basename($district->image));
    }

    public function downloadFile(District $district, DistrictFile $file): StreamedResponse
    {
        abort_unless($file->district_id === $district->id && $file->location && Storage::disk('public')->exists($file->location), 404);

        return Storage::disk('public')->download($file->location, basename($file->location));
    }

    public function destroyFile(District $district, DistrictFile $file): RedirectResponse
    {
        abort_unless($file->district_id === $district->id, 404);

        $this->deleteDistrictImage($file->location);
        $file->delete();

        return redirect()
            ->route('districts.edit', $district)
            ->with('success', __('districts.image_deleted'));
    }

    public function destroy(District $district): RedirectResponse
    {
        foreach ($district->files as $file) {
            $this->deleteDistrictImage($file->location);
            $file->delete();
        }

        $this->deleteDistrictImage($district->image);
        $district->delete();

        return redirect()
            ->route('districts.index')
            ->with('success', __('districts.deleted'));
    }

    private function storeDistrictImages(District $district, Request $request): void
    {
        if (! $request->hasFile('images')) {
            return;
        }

        foreach ($request->file('images') as $image) {
            $district->files()->create([
                'location' => $image->store('districts', 'public'),
            ]);
        }
    }

    private function deleteDistrictImage(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
