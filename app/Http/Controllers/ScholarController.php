<?php

namespace App\Http\Controllers;

use App\Enums\Language;
use App\Enums\RecordStatus;
use App\Http\Requests\ScholarStoreValidation;
use App\Http\Requests\ScholarUpdateValidation;
use App\Models\Scholar;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ScholarController extends Controller
{
    public function index(Request $request): View
    {
        $scholars = Scholar::query()
            ->with('user')
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

        return view('scholars.index', compact('scholars'));
    }

    public function create(): View
    {
        return view('scholars.create');
    }

    public function store(ScholarStoreValidation $request): RedirectResponse
    {
        $validated = $request->validated();

        $validated['slug'] = $validated['slug'] ?: Str::slug($validated['name']);
        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['lang'] = Language::from($validated['lang']);
        $validated['status'] = RecordStatus::from($validated['status']);
        $validated['user_id'] = $request->user()->id;

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('scholars', 'public');
        }

        Scholar::create($validated);

        return redirect()
            ->route('scholars.index')
            ->with('success', __('scholars.saved'));
    }

    public function edit(Scholar $scholar): View
    {
        return view('scholars.edit', compact('scholar'));
    }

    public function update(ScholarUpdateValidation $request, Scholar $scholar): RedirectResponse
    {
        $validated = $request->validated();

        $validated['slug'] = $validated['slug'] ?: Str::slug($validated['name']);
        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['lang'] = Language::from($validated['lang']);
        $validated['status'] = RecordStatus::from($validated['status']);

        if ($request->hasFile('image')) {
            $this->deleteScholarImage($scholar->image);
            $validated['image'] = $request->file('image')->store('scholars', 'public');
        }

        $scholar->update($validated);

        return redirect()
            ->route('scholars.index')
            ->with('success', __('scholars.updated'));
    }

    public function downloadImage(Scholar $scholar): StreamedResponse
    {
        abort_unless($scholar->image && Storage::disk('public')->exists($scholar->image), 404);

        return Storage::disk('public')->download($scholar->image, basename($scholar->image));
    }

    public function destroy(Scholar $scholar): RedirectResponse
    {
        $this->deleteScholarImage($scholar->image);
        $scholar->delete();

        return redirect()
            ->route('scholars.index')
            ->with('success', __('scholars.deleted'));
    }

    private function deleteScholarImage(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
