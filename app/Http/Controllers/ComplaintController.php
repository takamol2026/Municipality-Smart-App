<?php

namespace App\Http\Controllers;

use App\Enums\ComplaintStatus;
use App\Http\Requests\ComplaintUpdateValidation;
use App\Models\Complaint;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ComplaintController extends Controller
{
    public function index(Request $request): View
    {
        $complaints = Complaint::query()
            ->when($request->filled('name'), function ($query) use ($request) {
                $term = '%'.$request->string('name').'%';
                $query->where(function ($query) use ($term) {
                    $query->where('title', 'like', $term)
                        ->orWhere('description', 'like', $term);
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
}
