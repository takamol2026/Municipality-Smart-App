<?php

namespace App\Http\Controllers;

use App\Enums\RecordStatus;
use App\Http\Requests\HistoricalAttractionCategoryStoreValidation;
use App\Http\Requests\HistoricalAttractionCategoryUpdateValidation;
use App\Models\HistoricalAttractionCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class HistoricalAttractionCategoryController extends Controller
{
    public function index(Request $request): View
    {
        $categories = HistoricalAttractionCategory::query()
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

        return view('historical-attraction-categories.index', compact('categories'));
    }

    public function create(): View
    {
        return view('historical-attraction-categories.create');
    }

    public function store(HistoricalAttractionCategoryStoreValidation $request): RedirectResponse
    {
        $validated = $request->validated();

        $validated['slug'] = $validated['slug'] ?: Str::slug($validated['name']);
        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['status'] = RecordStatus::from($validated['status']);
        $validated['user_id'] = $request->user()->id;

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('historical-attraction-categories', 'public');
        }

        HistoricalAttractionCategory::create($validated);

        return redirect()
            ->route('historical-attraction-categories.index')
            ->with('success', __('common.category_saved'));
    }

    public function edit(HistoricalAttractionCategory $historicalAttractionCategory): View
    {
        return view('historical-attraction-categories.edit', [
            'category' => $historicalAttractionCategory,
        ]);
    }

    public function update(HistoricalAttractionCategoryUpdateValidation $request, HistoricalAttractionCategory $historicalAttractionCategory): RedirectResponse
    {
        $validated = $request->validated();

        $validated['slug'] = $validated['slug'] ?: Str::slug($validated['name']);
        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['status'] = RecordStatus::from($validated['status']);

        if ($request->hasFile('image')) {
            $this->deleteImage($historicalAttractionCategory->image);
            $validated['image'] = $request->file('image')->store('historical-attraction-categories', 'public');
        }

        $historicalAttractionCategory->update($validated);

        return redirect()
            ->route('historical-attraction-categories.index')
            ->with('success', __('common.category_updated'));
    }

    public function downloadImage(HistoricalAttractionCategory $historicalAttractionCategory): StreamedResponse
    {
        abort_unless($historicalAttractionCategory->image && Storage::disk('public')->exists($historicalAttractionCategory->image), 404);

        return Storage::disk('public')->download($historicalAttractionCategory->image, basename($historicalAttractionCategory->image));
    }

    public function destroy(HistoricalAttractionCategory $historicalAttractionCategory): RedirectResponse
    {
        if ($historicalAttractionCategory->attractions()->exists()) {
            return redirect()
                ->route('historical-attraction-categories.index')
                ->with('error', __('historical_attractions.category_delete_blocked'));
        }

        $this->deleteImage($historicalAttractionCategory->image);
        $historicalAttractionCategory->delete();

        return redirect()
            ->route('historical-attraction-categories.index')
            ->with('success', __('common.category_deleted'));
    }

    private function deleteImage(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
