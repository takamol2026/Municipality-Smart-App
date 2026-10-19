<?php

namespace App\Http\Controllers;

use App\Enums\Language;
use App\Enums\RecordStatus;
use App\Http\Requests\HistoricalAttractionStoreValidation;
use App\Http\Requests\HistoricalAttractionUpdateValidation;
use App\Models\HistoricalAttraction;
use App\Models\HistoricalAttractionCategory;
use App\Support\StoredImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class HistoricalAttractionController extends Controller
{
    public function index(Request $request): View
    {
        $attractions = HistoricalAttraction::query()
            ->with(['user', 'category'])
            ->when($request->filled('name'), function ($query) use ($request) {
                $query->where('name', 'like', '%'.$request->string('name').'%');
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

        return view('historical-attractions.index', compact('attractions'));
    }

    public function create(): View
    {
        return view('historical-attractions.create', [
            'categories' => $this->categories(),
        ]);
    }

    public function store(HistoricalAttractionStoreValidation $request): RedirectResponse
    {
        $validated = $request->validated();

        $validated['slug'] = $validated['slug'] ?: Str::slug($validated['name']);
        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['lang'] = Language::from($validated['lang']);
        $validated['status'] = RecordStatus::from($validated['status']);
        $validated['user_id'] = $request->user()->id;

        if ($request->hasFile('image')) {
            $validated['image'] = StoredImage::store($request->file('image'), 'historical-attractions');
        }

        HistoricalAttraction::create($validated);

        return redirect()
            ->route('historical-attractions.index')
            ->with('success', __('historical_attractions.saved'));
    }

    public function edit(HistoricalAttraction $historicalAttraction): View
    {
        return view('historical-attractions.edit', [
            'attraction' => $historicalAttraction,
            'categories' => $this->categories(),
        ]);
    }

    public function update(HistoricalAttractionUpdateValidation $request, HistoricalAttraction $historicalAttraction): RedirectResponse
    {
        $validated = $request->validated();

        $validated['slug'] = $validated['slug'] ?: Str::slug($validated['name']);
        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['lang'] = Language::from($validated['lang']);
        $validated['status'] = RecordStatus::from($validated['status']);

        if ($request->hasFile('image')) {
            $this->deleteImage($historicalAttraction->image);
            $validated['image'] = StoredImage::store($request->file('image'), 'historical-attractions');
        }

        $historicalAttraction->update($validated);

        return redirect()
            ->route('historical-attractions.index')
            ->with('success', __('historical_attractions.updated'));
    }

    public function downloadImage(HistoricalAttraction $historicalAttraction): StreamedResponse
    {
        abort_unless($historicalAttraction->image && Storage::disk('public')->exists($historicalAttraction->image), 404);

        return Storage::disk('public')->download($historicalAttraction->image, basename($historicalAttraction->image));
    }

    public function destroy(HistoricalAttraction $historicalAttraction): RedirectResponse
    {
        $this->deleteImage($historicalAttraction->image);
        $historicalAttraction->delete();

        return redirect()
            ->route('historical-attractions.index')
            ->with('success', __('historical_attractions.deleted'));
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection<int, HistoricalAttractionCategory>
     */
    private function categories()
    {
        return HistoricalAttractionCategory::query()
            ->orderBy('name')
            ->get();
    }

    private function deleteImage(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
