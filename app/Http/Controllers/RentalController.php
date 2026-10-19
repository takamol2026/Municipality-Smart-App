<?php

namespace App\Http\Controllers;

use App\Enums\Language;
use App\Enums\RecordStatus;
use App\Http\Requests\RentalStoreValidation;
use App\Http\Requests\RentalUpdateValidation;
use App\Models\Rental;
use App\Models\RentalCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class RentalController extends Controller
{
    public function index(Request $request): View
    {
        $rentals = Rental::query()
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

        return view('rentals.index', compact('rentals'));
    }

    public function create(): View
    {
        return view('rentals.create', [
            'categories' => $this->categories(),
        ]);
    }

    public function store(RentalStoreValidation $request): RedirectResponse
    {
        $validated = $request->validated();

        $validated['slug'] = $validated['slug'] ?: Str::slug($validated['name']);
        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['lang'] = Language::from($validated['lang']);
        $validated['status'] = RecordStatus::from($validated['status']);
        $validated['user_id'] = $request->user()->id;

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('rentals', 'public');
        }

        Rental::create($validated);

        return redirect()
            ->route('rentals.index')
            ->with('success', __('rentals.saved'));
    }

    public function edit(Rental $rental): View
    {
        return view('rentals.edit', [
            'rental' => $rental,
            'categories' => $this->categories(),
        ]);
    }

    public function update(RentalUpdateValidation $request, Rental $rental): RedirectResponse
    {
        $validated = $request->validated();

        $validated['slug'] = $validated['slug'] ?: Str::slug($validated['name']);
        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['lang'] = Language::from($validated['lang']);
        $validated['status'] = RecordStatus::from($validated['status']);

        if ($request->hasFile('image')) {
            $this->deleteImage($rental->image);
            $validated['image'] = $request->file('image')->store('rentals', 'public');
        }

        $rental->update($validated);

        return redirect()
            ->route('rentals.index')
            ->with('success', __('rentals.updated'));
    }

    public function downloadImage(Rental $rental): StreamedResponse
    {
        abort_unless($rental->image && Storage::disk('public')->exists($rental->image), 404);

        return Storage::disk('public')->download($rental->image, basename($rental->image));
    }

    public function destroy(Rental $rental): RedirectResponse
    {
        $this->deleteImage($rental->image);
        $rental->delete();

        return redirect()
            ->route('rentals.index')
            ->with('success', __('rentals.deleted'));
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection<int, RentalCategory>
     */
    private function categories()
    {
        return RentalCategory::query()
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
