<?php

namespace App\Http\Controllers;

use App\Enums\RecordStatus;
use App\Http\Requests\MapCategoryStoreValidation;
use App\Http\Requests\MapCategoryUpdateValidation;
use App\Models\MapCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class MapCategoryController extends Controller
{
    public function index(Request $request): View
    {
        $categories = MapCategory::query()
            ->with('user')
            ->when($request->filled('name'), function ($query) use ($request) {
                $query->where('name', 'like', '%'.$request->string('name').'%');
            })
            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where('status', $request->string('status'));
            })
            ->latest('id')
            ->paginate(15)
            ->withQueryString();

        return view('map-categories.index', compact('categories'));
    }

    public function create(): View
    {
        return view('map-categories.create');
    }

    public function store(MapCategoryStoreValidation $request): RedirectResponse
    {
        $validated = $request->validated();

        $validated['slug'] = $validated['slug'] ?: Str::slug($validated['name']);
        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['status'] = RecordStatus::from($validated['status']);
        $validated['user_id'] = $request->user()->id;

        if ($request->hasFile('img')) {
            $validated['img'] = $request->file('img')->store('map-categories', 'public');
        }

        MapCategory::create($validated);

        return redirect()
            ->route('map-categories.index')
            ->with('success', __('common.category_saved'));
    }

    public function edit(MapCategory $mapCategory): View
    {
        return view('map-categories.edit', [
            'category' => $mapCategory,
        ]);
    }

    public function update(MapCategoryUpdateValidation $request, MapCategory $mapCategory): RedirectResponse
    {
        $validated = $request->validated();

        $validated['slug'] = $validated['slug'] ?: Str::slug($validated['name']);
        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['status'] = RecordStatus::from($validated['status']);

        if ($request->hasFile('img')) {
            $this->deleteImage($mapCategory->img);
            $validated['img'] = $request->file('img')->store('map-categories', 'public');
        }

        $mapCategory->update($validated);

        return redirect()
            ->route('map-categories.index')
            ->with('success', __('common.category_updated'));
    }

    public function downloadImage(MapCategory $mapCategory): StreamedResponse
    {
        abort_unless($mapCategory->img && Storage::disk('public')->exists($mapCategory->img), 404);

        return Storage::disk('public')->download($mapCategory->img, basename($mapCategory->img));
    }

    public function destroy(MapCategory $mapCategory): RedirectResponse
    {
        if ($mapCategory->locations()->exists()) {
            return redirect()
                ->route('map-categories.index')
                ->with('error', __('map_locations.category_delete_blocked'));
        }

        $this->deleteImage($mapCategory->img);
        $mapCategory->delete();

        return redirect()
            ->route('map-categories.index')
            ->with('success', __('common.category_deleted'));
    }

    private function deleteImage(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
