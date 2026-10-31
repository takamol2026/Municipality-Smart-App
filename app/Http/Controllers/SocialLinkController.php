<?php

namespace App\Http\Controllers;

use App\Enums\RecordStatus;
use App\Enums\SocialNetwork;
use App\Http\Requests\SocialLinkStoreValidation;
use App\Http\Requests\SocialLinkUpdateValidation;
use App\Models\SocialLink;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SocialLinkController extends Controller
{
    public function index(Request $request): View
    {
        $links = SocialLink::query()
            ->with('user')
            ->when($request->filled('network'), function ($query) use ($request) {
                $query->where('network', $request->string('network'));
            })
            ->when($request->filled('url'), function ($query) use ($request) {
                $query->where('url', 'like', '%'.$request->string('url').'%');
            })
            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where('status', $request->string('status'));
            })
            ->orderBy('sort_order')
            ->latest('id')
            ->paginate(15)
            ->withQueryString();

        return view('social-links.index', compact('links'));
    }

    public function create(): View
    {
        return view('social-links.create');
    }

    public function store(SocialLinkStoreValidation $request): RedirectResponse
    {
        $validated = $request->validated();

        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['network'] = SocialNetwork::from($validated['network']);
        $validated['status'] = RecordStatus::from($validated['status']);
        $validated['user_id'] = $request->user()->id;

        SocialLink::query()->create($validated);

        return redirect()
            ->route('social-links.index')
            ->with('success', __('social_links.saved'));
    }

    public function edit(SocialLink $socialLink): View
    {
        return view('social-links.edit', [
            'link' => $socialLink,
        ]);
    }

    public function update(SocialLinkUpdateValidation $request, SocialLink $socialLink): RedirectResponse
    {
        $validated = $request->validated();

        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['network'] = SocialNetwork::from($validated['network']);
        $validated['status'] = RecordStatus::from($validated['status']);

        $socialLink->update($validated);

        return redirect()
            ->route('social-links.index')
            ->with('success', __('social_links.updated'));
    }

    public function destroy(SocialLink $socialLink): RedirectResponse
    {
        $socialLink->delete();

        return redirect()
            ->route('social-links.index')
            ->with('success', __('social_links.deleted'));
    }
}
