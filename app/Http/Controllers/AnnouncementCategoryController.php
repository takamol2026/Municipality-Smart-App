<?php

namespace App\Http\Controllers;

use App\Enums\Language;
use App\Enums\RecordStatus;
use App\Http\Requests\AnnouncementCategoryStoreValidation;
use App\Http\Requests\AnnouncementCategoryUpdateValidation;
use App\Models\AnnouncementCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AnnouncementCategoryController extends Controller
{
    public function index(Request $request): View
    {
        $categories = AnnouncementCategory::query()
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

        return view('announcement-categories.index', compact('categories'));
    }

    public function create(): View
    {
        return view('announcement-categories.create');
    }

    public function store(AnnouncementCategoryStoreValidation $request): RedirectResponse
    {
        $validated = $request->validated();

        $validated['slug'] = $validated['slug'] ?: Str::slug($validated['name']);
        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['lang'] = Language::from($validated['lang']);
        $validated['status'] = RecordStatus::from($validated['status']);
        $validated['user_id'] = $request->user()->id;

        AnnouncementCategory::create($validated);

        return redirect()
            ->route('announcement-categories.index')
            ->with('success', __('common.category_saved'));
    }

    public function edit(AnnouncementCategory $announcementCategory): View
    {
        return view('announcement-categories.edit', [
            'category' => $announcementCategory,
        ]);
    }

    public function update(AnnouncementCategoryUpdateValidation $request, AnnouncementCategory $announcementCategory): RedirectResponse
    {
        $validated = $request->validated();

        $validated['slug'] = $validated['slug'] ?: Str::slug($validated['name']);
        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['lang'] = Language::from($validated['lang']);
        $validated['status'] = RecordStatus::from($validated['status']);

        $announcementCategory->update($validated);

        return redirect()
            ->route('announcement-categories.index')
            ->with('success', __('common.category_updated'));
    }

    public function destroy(AnnouncementCategory $announcementCategory): RedirectResponse
    {
        if ($announcementCategory->announcements()->exists()) {
            return redirect()
                ->route('announcement-categories.index')
                ->with('error', __('announcements.category_delete_blocked'));
        }

        $announcementCategory->delete();

        return redirect()
            ->route('announcement-categories.index')
            ->with('success', __('common.category_deleted'));
    }
}
