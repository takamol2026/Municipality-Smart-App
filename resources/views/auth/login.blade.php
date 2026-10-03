@extends('layouts.guest')

@section('title', 'ورود')

@section('content')
    <h2>ورود</h2>
    <p class="lede">با ایمیل یا نام کاربری وارد شوید.</p>

    @if (session('status'))
        <p class="alert">{{ session('status') }}</p>
    @endif

    @if ($errors->any() && ! $errors->has('login') && ! $errors->has('password'))
        <p class="alert error">{{ $errors->first() }}</p>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <x-text-field label="ایمیل یا نام کاربری" name="login" autocomplete="username" autofocus required />

        <x-text-field label="رمز عبور" name="password" type="password" autocomplete="current-password" required />

        <div class="row">
            <label class="check">
                <input type="checkbox" name="remember" value="1" @checked(old('remember'))>
                مرا به خاطر بسپار
            </label>
            <a href="{{ route('password.request') }}">فراموشی رمز</a>
        </div>

        <button class="button" type="submit">ورود</button>
    </form>

    <p class="switch">حساب ندارید؟ <a href="{{ route('register') }}">ثبت‌نام</a></p>
@endsection
