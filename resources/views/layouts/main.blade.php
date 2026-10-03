<!doctype html>
<html lang="fa" data-layout="vertical" data-sidebar="dark" data-sidebar-image="img-1" data-sidebar-size="lg" data-preloader="disable" data-theme="default" dir="rtl" data-topbar="light" data-bs-theme="light" data-theme-color="0">

<head>
    <meta charset="utf-8">
    <title>@yield('title', 'پنل مدیریت') | داسیکس</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Minimal Admin & Dashboard Template" name="description">
    <meta content="Themesbrand" name="author">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @include('layouts.partials.head')
    @stack('styles')
</head>

<body>
    <div id="layout-wrapper">
        @include('layouts.partials.sidebar')

        @include('layouts.partials.header')

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    @hasSection('breadcrumb')
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            @yield('breadcrumb')
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @yield('content')
                </div>
            </div>

            @include('layouts.partials.footer')
        </div>
    </div>

    @include('layouts.partials.theme-settings')
    @include('layouts.partials.scripts')
    @stack('scripts')
</body>

</html>
