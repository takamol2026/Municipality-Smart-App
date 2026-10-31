<?php

namespace App\Http\Controllers;

use App\Enums\SuggestionStatus;
use App\Http\Requests\SuggestionUpdateValidation;
use App\Models\Suggestion;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class SuggestionController extends Controller
{
    public function index(Request $request): View
    {
        $suggestions = Suggestion::query()
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

        return view('suggestions.index', compact('suggestions'));
    }

    public function update(SuggestionUpdateValidation $request, Suggestion $suggestion): RedirectResponse
    {
        $suggestion->update([
            'status' => SuggestionStatus::from($request->validated('status')),
        ]);

        return redirect()
            ->back()
            ->with('success', __('suggestions.status_updated'));
    }

    public function downloadImage(Suggestion $suggestion): StreamedResponse
    {
        abort_unless($suggestion->image && Storage::disk('public')->exists($suggestion->image), 404);

        return Storage::disk('public')->download($suggestion->image, basename($suggestion->image));
    }
}
