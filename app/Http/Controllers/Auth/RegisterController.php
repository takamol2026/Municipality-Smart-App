<?php

namespace App\Http\Controllers\Auth;

use App\Enums\RecordStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class RegisterController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(RegisterRequest $request): RedirectResponse
    {
        $user = User::create([
            'name' => $request->string('name')->toString(),
            'last_name' => $request->input('last_name'),
            'phone' => $request->input('phone'),
            'email' => $request->string('email')->toString(),
            'username' => $request->string('username')->toString(),
            'password' => $request->string('password')->toString(),
            'status' => RecordStatus::Active,
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('dashboard');
    }
}
