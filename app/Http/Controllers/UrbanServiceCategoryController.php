<?php

namespace App\Http\Controllers;

use App\Enums\Language;
use App\Enums\RecordStatus;
use App\Http\Requests\UrbanServiceCategoryStoreValidation;
use App\Http\Requests\UrbanServiceCategoryUpdateValidation;
use App\Models\UrbanServiceCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class UrbanServiceCategoryController extends Controller
{
    public function index(Request $request): View
    {
        $categories = UrbanServiceCategory::query()
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

        return view('urban-service-categories.index', compact('categories'));
    }

    public function create(): View
    {
        return view('urban-service-categories.create');
    }

    public function store(UrbanServiceCategoryStoreValidation $request): RedirectResponse
    {
        $validated = $request->validated();

        $validated['slug'] = $validated['slug'] ?: Str::slug($validated['name']);
        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['lang'] = Language::from($validated['lang']);
        $validated['status'] = RecordStatus::from($validated['status']);
        $validated['user_id'] = $request->user()->id;

        UrbanServiceCategory::create($validated);

        return redirect()
            ->route('urban-service-categories.index')
            ->with('success', __('common.category_saved'));
    }

    public function edit(UrbanServiceCategory $urbanServiceCategory): View
    {
        return view('urban-service-categories.edit', [
            'category' => $urbanServiceCategory,
        ]);
    }

    public function update(UrbanServiceCategoryUpdateValidation $request, UrbanServiceCategory $urbanServiceCategory): RedirectResponse
    {
        $validated = $request->validated();

        $validated['slug'] = $validated['slug'] ?: Str::slug($validated['name']);
        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['lang'] = Language::from($validated['lang']);
        $validated['status'] = RecordStatus::from($validated['status']);

        $urbanServiceCategory->update($validated);

        return redirect()
            ->route('urban-service-categories.index')
            ->with('success', __('common.category_updated'));
    }

    public function destroy(UrbanServiceCategory $urbanServiceCategory): RedirectResponse
    {
        if ($urbanServiceCategory->services()->exists()) {
            return redirect()
                ->route('urban-service-categories.index')
                ->with('error', __('urban_services.category_delete_blocked'));
        }

        $urbanServiceCategory->delete();

        return redirect()
            ->route('urban-service-categories.index')
            ->with('success', __('common.category_deleted'));
    }
}
