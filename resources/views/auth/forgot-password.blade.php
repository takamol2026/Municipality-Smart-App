@extends('layouts.guest')

@section('title', 'بازیابی رمز عبور')

@section('content')
    <h2>بازیابی رمز</h2>
    <p class="lede">ایمیل حساب را وارد کنید تا لینک تغییر رمز ارسال شود.</p>

    @if (session('status'))
        <p class="alert">{{ session('status') }}</p>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <x-text-field label="ایمیل" name="email" type="email" autocomplete="email" autofocus required />
        <button class="button" type="submit">ارسال لینک</button>
    </form>

    <p class="switch"><a href="{{ route('login') }}">بازگشت به ورود</a></p>
@endsection
