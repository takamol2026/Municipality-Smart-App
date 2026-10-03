<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ], [
            'email.required' => 'ایمیل را وارد کنید.',
            'email.email' => 'ایمیل معتبر نیست.',
        ]);

        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', $this->message($status))
            : back()->withInput($request->only('email'))->withErrors(['email' => $this->message($status)]);
    }

    private function message(string $status): string
    {
        return match ($status) {
            Password::RESET_LINK_SENT => 'لینک بازیابی رمز عبور ارسال شد.',
            Password::INVALID_USER => 'کاربری با این ایمیل پیدا نشد.',
            Password::RESET_THROTTLED => 'لطفاً کمی بعد دوباره تلاش کنید.',
            default => 'ارسال لینک انجام نشد.',
        };
    }
}
