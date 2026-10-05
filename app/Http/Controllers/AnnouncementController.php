<?php

namespace App\Http\Controllers;

use App\Enums\RecordStatus;
use App\Http\Requests\AnnouncementStoreValidation;
use App\Http\Requests\AnnouncementUpdateValidation;
use App\Models\Announcement;
use App\Models\AnnouncementCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AnnouncementController extends Controller
{
    public function index(Request $request): View
    {
        $announcements = Announcement::query()
            ->with(['user', 'category'])
            ->when($request->filled('name'), function ($query) use ($request) {
                $query->where('title', 'like', '%'.$request->string('name').'%');
            })
            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where('status', $request->string('status'));
            })
            ->latest('id')
            ->paginate(15)
            ->withQueryString();

        return view('announcements.index', compact('announcements'));
    }

    public function create(): View
    {
        return view('announcements.create', [
            'categories' => $this->categories(),
        ]);
    }

    public function store(AnnouncementStoreValidation $request): RedirectResponse
    {
        $validated = $request->validated();

        $validated['slug'] = $validated['slug'] ?: Str::slug($validated['title']);
        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['status'] = RecordStatus::from($validated['status']);
        $validated['user_id'] = $request->user()->id;

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('announcements', 'public');
        }

        if ($request->hasFile('attachment')) {
            $validated['attachment'] = $request->file('attachment')->store('announcements/attachments', 'public');
        }

        Announcement::create($validated);

        return redirect()
            ->route('announcements.index')
            ->with('success', 'اطلاعیه با موفقیت ذخیره شد.');
    }

    public function edit(Announcement $announcement): View
    {
        return view('announcements.edit', [
            'announcement' => $announcement,
            'categories' => $this->categories(),
        ]);
    }

    public function update(AnnouncementUpdateValidation $request, Announcement $announcement): RedirectResponse
    {
        $validated = $request->validated();

        $validated['slug'] = $validated['slug'] ?: Str::slug($validated['title']);
        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['status'] = RecordStatus::from($validated['status']);

        if ($request->hasFile('image')) {
            $this->deleteFile($announcement->image);
            $validated['image'] = $request->file('image')->store('announcements', 'public');
        }

        if ($request->hasFile('attachment')) {
            $this->deleteFile($announcement->attachment);
            $validated['attachment'] = $request->file('attachment')->store('announcements/attachments', 'public');
        }

        $announcement->update($validated);

        return redirect()
            ->route('announcements.index')
            ->with('success', 'اطلاعیه با موفقیت ویرایش شد.');
    }

    public function downloadImage(Announcement $announcement): StreamedResponse
    {
        abort_unless($announcement->image && Storage::disk('public')->exists($announcement->image), 404);

        return Storage::disk('public')->download($announcement->image, basename($announcement->image));
    }

    public function downloadAttachment(Announcement $announcement): StreamedResponse
    {
        abort_unless($announcement->attachment && Storage::disk('public')->exists($announcement->attachment), 404);

        return Storage::disk('public')->download($announcement->attachment, basename($announcement->attachment));
    }

    public function destroy(Announcement $announcement): RedirectResponse
    {
        $this->deleteFile($announcement->image);
        $this->deleteFile($announcement->attachment);
        $announcement->delete();

        return redirect()
            ->route('announcements.index')
            ->with('success', 'اطلاعیه با موفقیت حذف شد.');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection<int, AnnouncementCategory>
     */
    private function categories()
    {
        return AnnouncementCategory::query()
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
