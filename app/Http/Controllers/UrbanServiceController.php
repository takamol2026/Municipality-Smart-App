<?php

namespace App\Http\Controllers;

use App\Enums\RecordStatus;
use App\Http\Requests\UrbanServiceStoreValidation;
use App\Http\Requests\UrbanServiceUpdateValidation;
use App\Models\UrbanService;
use App\Models\UrbanServiceCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class UrbanServiceController extends Controller
{
    public function index(Request $request): View
    {
        $services = UrbanService::query()
            ->with(['user', 'category'])
            ->when($request->filled('name'), function ($query) use ($request) {
                $query->where('name', 'like', '%'.$request->string('name').'%');
            })
            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where('status', $request->string('status'));
            })
            ->latest('id')
            ->paginate(15)
            ->withQueryString();

        return view('urban-services.index', compact('services'));
    }

    public function create(): View
    {
        return view('urban-services.create', [
            'categories' => $this->categories(),
        ]);
    }

    public function store(UrbanServiceStoreValidation $request): RedirectResponse
    {
        $validated = $request->validated();

        $validated['slug'] = $validated['slug'] ?: Str::slug($validated['name']);
        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['status'] = RecordStatus::from($validated['status']);
        $validated['user_id'] = $request->user()->id;

        UrbanService::create($validated);

        return redirect()
            ->route('urban-services.index')
            ->with('success', 'خدمت با موفقیت ذخیره شد.');
    }

    public function edit(UrbanService $urbanService): View
    {
        return view('urban-services.edit', [
            'service' => $urbanService,
            'categories' => $this->categories(),
        ]);
    }

    public function update(UrbanServiceUpdateValidation $request, UrbanService $urbanService): RedirectResponse
    {
        $validated = $request->validated();

        $validated['slug'] = $validated['slug'] ?: Str::slug($validated['name']);
        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['status'] = RecordStatus::from($validated['status']);

        $urbanService->update($validated);

        return redirect()
            ->route('urban-services.index')
            ->with('success', 'خدمت با موفقیت ویرایش شد.');
    }

    public function destroy(UrbanService $urbanService): RedirectResponse
    {
        $urbanService->delete();

        return redirect()
            ->route('urban-services.index')
            ->with('success', 'خدمت با موفقیت حذف شد.');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection<int, UrbanServiceCategory>
     */
    private function categories()
    {
        return UrbanServiceCategory::query()
            ->orderBy('name')
            ->get();
    }
}
