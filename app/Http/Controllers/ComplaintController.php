<?php

namespace App\Http\Controllers;

use App\Enums\ComplaintStatus;
use App\Http\Requests\ComplaintUpdateValidation;
use App\Models\Complaint;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ComplaintController extends Controller
{
    public function index(Request $request): View
    {
        $complaints = Complaint::query()
            ->with('district')
            ->when($request->filled('name'), function ($query) use ($request) {
                $term = '%'.$request->string('name').'%';
                $query->where(function ($query) use ($term) {
                    $query->where('title', 'like', $term)
                        ->orWhere('description', 'like', $term)
                        ->orWhere('full_name', 'like', $term)
                        ->orWhere('phone', 'like', $term);
                });
            })
            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where('status', $request->string('status'));
            })
            ->latest('id')
            ->paginate(15)
            ->withQueryString();

        return view('complaints.index', compact('complaints'));
    }

    public function update(ComplaintUpdateValidation $request, Complaint $complaint): RedirectResponse
    {
        $complaint->update([
            'status' => ComplaintStatus::from($request->validated('status')),
        ]);

        return redirect()
            ->back()
            ->with('success', __('complaints.status_updated'));
    }

    public function downloadImage(Complaint $complaint): StreamedResponse
    {
        abort_unless($complaint->image && Storage::disk('public')->exists($complaint->image), 404);

        return Storage::disk('public')->download($complaint->image, basename($complaint->image));
    }
}
