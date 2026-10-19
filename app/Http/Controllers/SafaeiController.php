<?php

namespace App\Http\Controllers;

use App\Enums\Language;
use App\Enums\RecordStatus;
use App\Http\Requests\SafaeiStoreValidation;
use App\Http\Requests\SafaeiUpdateValidation;
use App\Models\Safaei;
use App\Models\SafaeiCategory;
use App\Models\SafaeiPhoto;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class SafaeiController extends Controller
{
    public function index(Request $request): View
    {
        $files = SafaeiPhoto::query()
            ->with('safaei')
            ->when($request->filled('name'), function ($query) use ($request) {
                $query->whereHas('safaei', function ($safaeiQuery) use ($request) {
                    $safaeiQuery->where('title', 'like', '%'.$request->string('name').'%');
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
        $file = $request->file('file');
        unset($validated['file']);

        $validated['lang'] = Language::from($validated['lang']);
        $validated['status'] = RecordStatus::from($validated['status']);
        $validated['user_id'] = $request->user()->id;

        $safaei = Safaei::create($validated);

        $safaei->photos()->create([
            'file_path' => $file->store('safaei', 'public'),
        ]);

        return redirect()
            ->route('safaei.index')
            ->with('success', __('safaei.saved'));
    }

    public function edit(SafaeiPhoto $safaei): View
    {
        return view('safaei.edit', [
            'safaei' => $safaei,
            'safaeis' => $this->safaeis(),
        ]);
    }

    public function update(SafaeiUpdateValidation $request, SafaeiPhoto $safaei): RedirectResponse
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
            ->with('success', __('safaei.updated'));
    }

    public function download(SafaeiPhoto $safaei): StreamedResponse
    {
        abort_unless($safaei->file_path && Storage::disk('public')->exists($safaei->file_path), 404);

        return Storage::disk('public')->download($safaei->file_path, basename($safaei->file_path));
    }

    public function destroy(SafaeiPhoto $safaei): RedirectResponse
    {
        $this->deleteFile($safaei->file_path);
        $safaei->delete();

        return redirect()
            ->route('safaei.index')
            ->with('success', __('safaei.deleted'));
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

    /**
     * @return \Illuminate\Database\Eloquent\Collection<int, Safaei>
     */
    private function safaeis()
    {
        return Safaei::query()
            ->orderBy('title')
            ->get();
    }

    private function deleteFile(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
