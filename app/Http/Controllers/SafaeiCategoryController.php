<?php

namespace App\Http\Controllers;

use App\Enums\RecordStatus;
use App\Http\Requests\SafaeiCategoryStoreValidation;
use App\Http\Requests\SafaeiCategoryUpdateValidation;
use App\Models\SafaeiCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SafaeiCategoryController extends Controller
{
    public function index(Request $request): View
    {
        $categories = SafaeiCategory::query()
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

        return view('safaei-categories.index', compact('categories'));
    }

    public function create(): View
    {
        return view('safaei-categories.create');
    }

    public function store(SafaeiCategoryStoreValidation $request): RedirectResponse
    {
        $validated = $request->validated();

        $validated['status'] = RecordStatus::from($validated['status']);
        $validated['user_id'] = $request->user()->id;

        SafaeiCategory::create($validated);

        return redirect()
            ->route('safaei-categories.index')
            ->with('success', 'دسته‌بندی با موفقیت ذخیره شد.');
    }

    public function edit(SafaeiCategory $safaeiCategory): View
    {
        return view('safaei-categories.edit', [
            'category' => $safaeiCategory,
        ]);
    }

    public function update(SafaeiCategoryUpdateValidation $request, SafaeiCategory $safaeiCategory): RedirectResponse
    {
        $validated = $request->validated();
        $validated['status'] = RecordStatus::from($validated['status']);

        $safaeiCategory->update($validated);

        return redirect()
            ->route('safaei-categories.index')
            ->with('success', 'دسته‌بندی با موفقیت ویرایش شد.');
    }

    public function destroy(SafaeiCategory $safaeiCategory): RedirectResponse
    {
        if ($safaeiCategory->files()->exists()) {
            return redirect()
                ->route('safaei-categories.index')
                ->with('error', 'این دسته‌بندی به دلیل داشتن فایل قابل حذف نیست.');
        }

        $safaeiCategory->delete();

        return redirect()
            ->route('safaei-categories.index')
            ->with('success', 'دسته‌بندی با موفقیت حذف شد.');
    }
}
