<?php

namespace App\Http\Controllers;

use App\Enums\RecordStatus;
use App\Models\Scholar;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ScholarController extends Controller
{
    public function index(): View
    {
        $scholars = Scholar::query()
            ->latest()
            ->paginate(15);

        return view('scholars.index', compact('scholars'));
    }

    public function create(): View
    {
        return view('scholars.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:scholars,slug'],
            'short_bio' => ['nullable', 'string'],
            'biography' => ['nullable', 'string'],
            'birth_date' => ['nullable', 'date'],
            'death_date' => ['nullable', 'date', 'after_or_equal:birth_date'],
            'education' => ['nullable', 'string'],
            'works' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:2048'],
            'status' => ['required', 'in:active,inactive'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $validated['slug'] = $validated['slug'] ?: Str::slug($validated['name']);
        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['status'] = RecordStatus::from($validated['status']);
        $validated['user_id'] = $request->user()->id;

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('scholars', 'public');
        }

        Scholar::create($validated);

        return redirect()
            ->route('scholars.index')
            ->with('success', 'عالم با موفقیت ذخیره شد.');
    }
}
