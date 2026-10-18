<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfilePasswordUpdateValidation;
use App\Http\Requests\ProfileUpdateValidation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(): View
    {
        return view('profile.edit', [
            'user' => auth()->user(),
        ]);
    }

    public function update(ProfileUpdateValidation $request): RedirectResponse
    {
        $request->user()->update($request->validated());

        return redirect()
            ->route('profile.edit')
            ->with('success', __('profile.updated'));
    }

    public function updatePassword(ProfilePasswordUpdateValidation $request): RedirectResponse
    {
        $user = $request->user();

        if (! Hash::check($request->string('current_password')->toString(), $user->password)) {
            return back()
                ->withErrors(['current_password' => __('profile.current_password_invalid')])
                ->withInput();
        }

        $user->update([
            'password' => $request->string('password')->toString(),
        ]);

        return redirect()
            ->route('profile.edit')
            ->with('password_success', __('profile.password_updated'));
    }
}
