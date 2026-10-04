<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UserStoreValidation extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'username' => ['required', 'string', 'min:3', 'max:50', 'regex:/^[A-Za-z0-9._-]+$/', 'unique:users,username'],
            'password' => ['required', 'confirmed', Password::min(8)],
            'status' => ['required', 'in:active,inactive'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'نام را وارد کنید.',
            'email.required' => 'ایمیل را وارد کنید.',
            'email.email' => 'ایمیل معتبر نیست.',
            'email.unique' => 'این ایمیل قبلاً ثبت شده است.',
            'username.required' => 'نام کاربری را وارد کنید.',
            'username.min' => 'نام کاربری حداقل ۳ حرف باشد.',
            'username.regex' => 'نام کاربری فقط می‌تواند حرف انگلیسی، عدد، نقطه، خط تیره و زیرخط داشته باشد.',
            'username.unique' => 'این نام کاربری قبلاً ثبت شده است.',
            'password.required' => 'رمز عبور را وارد کنید.',
            'password.confirmed' => 'تکرار رمز عبور یکسان نیست.',
            'password.min' => 'رمز عبور حداقل ۸ حرف باشد.',
            'status.required' => 'وضعیت را انتخاب کنید.',
        ];
    }
}
