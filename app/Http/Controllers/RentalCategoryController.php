<?php

namespace App\Http\Controllers;

use App\Enums\RecordStatus;
use App\Http\Requests\RentalCategoryStoreValidation;
use App\Http\Requests\RentalCategoryUpdateValidation;
use App\Models\RentalCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class RentalCategoryController extends Controller
{
    public function index(Request $request): View
    {
        $categories = RentalCategory::query()
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

        return view('rental-categories.index', compact('categories'));
    }

    public function create(): View
    {
        return view('rental-categories.create');
    }

    public function store(RentalCategoryStoreValidation $request): RedirectResponse
    {
        $validated = $request->validated();

        $validated['slug'] = $validated['slug'] ?: Str::slug($validated['name']);
        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['status'] = RecordStatus::from($validated['status']);
        $validated['user_id'] = $request->user()->id;

        if ($request->hasFile('img')) {
            $validated['img'] = $request->file('img')->store('rental-categories', 'public');
        }

        RentalCategory::create($validated);

        return redirect()
            ->route('rental-categories.index')
            ->with('success', __('common.category_saved'));
    }

    public function edit(RentalCategory $rentalCategory): View
    {
        return view('rental-categories.edit', [
            'category' => $rentalCategory,
        ]);
    }

    public function update(RentalCategoryUpdateValidation $request, RentalCategory $rentalCategory): RedirectResponse
    {
        $validated = $request->validated();

        $validated['slug'] = $validated['slug'] ?: Str::slug($validated['name']);
        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['status'] = RecordStatus::from($validated['status']);

        if ($request->hasFile('img')) {
            $this->deleteImage($rentalCategory->img);
            $validated['img'] = $request->file('img')->store('rental-categories', 'public');
        }

        $rentalCategory->update($validated);

        return redirect()
            ->route('rental-categories.index')
            ->with('success', __('common.category_updated'));
    }

    public function downloadImage(RentalCategory $rentalCategory): StreamedResponse
    {
        abort_unless($rentalCategory->img && Storage::disk('public')->exists($rentalCategory->img), 404);

        return Storage::disk('public')->download($rentalCategory->img, basename($rentalCategory->img));
    }

    public function destroy(RentalCategory $rentalCategory): RedirectResponse
    {
        if ($rentalCategory->rentals()->exists()) {
            return redirect()
                ->route('rental-categories.index')
                ->with('error', __('rentals.category_delete_blocked'));
        }

        $this->deleteImage($rentalCategory->img);
        $rentalCategory->delete();

        return redirect()
            ->route('rental-categories.index')
            ->with('success', __('common.category_deleted'));
    }

    private function deleteImage(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
