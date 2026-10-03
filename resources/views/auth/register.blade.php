@extends('layouts.guest')

@section('title', 'ثبت‌نام')

@section('content')
    <h2>ثبت‌نام</h2>
    <p class="lede">برای دسترسی به پنل، حساب کاربری بسازید.</p>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <x-text-field label="نام" name="name" autocomplete="given-name" autofocus required />
        <x-text-field label="نام خانوادگی" name="last_name" autocomplete="family-name" />
        <x-text-field label="تلفن" name="phone" autocomplete="tel" />
        <x-text-field label="ایمیل" name="email" type="email" autocomplete="email" required />
        <x-text-field label="نام کاربری" name="username" autocomplete="username" required />
        <x-text-field label="رمز عبور" name="password" type="password" autocomplete="new-password" required />
        <x-text-field label="تکرار رمز عبور" name="password_confirmation" type="password" autocomplete="new-password" required />

        <button class="button" type="submit">ساخت حساب</button>
    </form>

    <p class="switch">حساب دارید؟ <a href="{{ route('login') }}">ورود</a></p>
@endsection
