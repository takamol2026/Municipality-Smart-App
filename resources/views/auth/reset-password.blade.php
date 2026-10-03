@extends('layouts.guest')

@section('title', 'رمز عبور جدید')

@section('content')
    <h2>رمز جدید</h2>
    <p class="lede">رمز تازه را برای همین حساب انتخاب کنید.</p>

    <form method="POST" action="{{ route('password.store') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <x-text-field label="ایمیل" name="email" type="email" autocomplete="email" :value="$email" required />
        <x-text-field label="رمز عبور جدید" name="password" type="password" autocomplete="new-password" required />
        <x-text-field label="تکرار رمز عبور" name="password_confirmation" type="password" autocomplete="new-password" required />
        <button class="button" type="submit">ذخیره رمز</button>
    </form>
@endsection
