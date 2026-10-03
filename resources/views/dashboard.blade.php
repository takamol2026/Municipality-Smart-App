@extends('layouts.app')

@section('title', 'داشبورد')

@section('content')
    <section class="panel">
        <h1>سلام، {{ auth()->user()->name }}</h1>
        <p class="lede">وارد پنل مدیریت شدید.</p>

        <div class="facts">
            <div>
                <span>نام کاربری</span>
                <strong>{{ auth()->user()->username }}</strong>
            </div>
            <div>
                <span>ایمیل</span>
                <strong>{{ auth()->user()->email }}</strong>
            </div>
            <div>
                <span>وضعیت</span>
                <strong>{{ auth()->user()->status->value === 'active' ? 'فعال' : 'غیرفعال' }}</strong>
            </div>
        </div>
    </section>
@endsection
