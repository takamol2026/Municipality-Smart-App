<?php

namespace App\Http\Controllers;

use App\Http\Requests\SafaeiStoreValidation;
use App\Http\Requests\SafaeiUpdateValidation;
use App\Models\Safaei;
use App\Models\SafaeiCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class SafaeiController extends Controller
{
    public function index(Request $request): View
    {
        $files = Safaei::query()
            ->with('category')
            ->when($request->filled('name'), function ($query) use ($request) {
                $query->whereHas('category', function ($categoryQuery) use ($request) {
                    $categoryQuery->where('name', 'like', '%'.$request->string('name').'%');
                });
            })
            ->latest('id')
            ->paginate(15)
            ->withQueryString();

        return view('safaei.index', compact('files'));
    }

    public function create(): View
    {
        return view('safaei.create', [
            'categories' => $this->categories(),
        ]);
    }

    public function store(SafaeiStoreValidation $request): RedirectResponse
    {
        $validated = $request->validated();
        unset($validated['file']);

        if ($request->hasFile('file')) {
            $validated['file_path'] = $request->file('file')->store('safaei', 'public');
        }

        Safaei::create($validated);

        return redirect()
            ->route('safaei.index')
            ->with('success', 'فایل با موفقیت ذخیره شد.');
    }

    public function edit(Safaei $safaei): View
    {
        return view('safaei.edit', [
            'safaei' => $safaei,
            'categories' => $this->categories(),
        ]);
    }

    public function update(SafaeiUpdateValidation $request, Safaei $safaei): RedirectResponse
    {
        $validated = $request->validated();
        unset($validated['file']);

        if ($request->hasFile('file')) {
            $this->deleteFile($safaei->file_path);
            $validated['file_path'] = $request->file('file')->store('safaei', 'public');
        }

        $safaei->update($validated);

        return redirect()
            ->route('safaei.index')
            ->with('success', 'فایل با موفقیت ویرایش شد.');
    }

    public function download(Safaei $safaei): StreamedResponse
    {
        abort_unless($safaei->file_path && Storage::disk('public')->exists($safaei->file_path), 404);

        return Storage::disk('public')->download($safaei->file_path, basename($safaei->file_path));
    }

    public function destroy(Safaei $safaei): RedirectResponse
    {
        $this->deleteFile($safaei->file_path);
        $safaei->delete();

        return redirect()
            ->route('safaei.index')
            ->with('success', 'فایل با موفقیت حذف شد.');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection<int, SafaeiCategory>
     */
    private function categories()
    {
        return SafaeiCategory::query()
            ->orderBy('name')
            ->get();
    }

    private function deleteFile(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
