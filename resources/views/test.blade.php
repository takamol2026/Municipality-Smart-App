@extends('layouts.main')

@section('title', 'تست')
@section('page-title', 'صفحه تست')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="javascript:void(0);">صفحه</a></li>
    <li class="breadcrumb-item active">تست</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">لایه اصلی با موفقیت لود شد</h5>
                </div>
                <div class="card-body">
                    <p class="mb-0">
                        این صفحه از <code>layouts.main</code> اکستند شده و بخش‌های هدر، سایدبار و فوتر را از partialها می‌گیرد.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
