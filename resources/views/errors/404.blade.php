<!doctype html>
<html lang="fa" data-layout="vertical" data-sidebar="dark" data-sidebar-image="img-1" data-sidebar-size="lg" data-preloader="disable" data-theme="default" dir="rtl" data-topbar="light" data-bs-theme="light" data-theme-color="0">

<head>
    <meta charset="utf-8">
    <title>صفحه پیدا نشد | پنل مدیریت</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('assets/assets/images/municipality_logo.jpg') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <script src="{{ asset('assets/assets/js/layout.js') }}"></script>
    <link href="{{ asset('assets/assets/css/bootstrap-rtl.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/assets/css/app-rtl.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/assets/css/custom-rtl.min.css') }}" rel="stylesheet" type="text/css">
</head>

<body>
    <section class="auth-page-wrapper overflow-hidden p-4 position-relative d-flex align-items-center justify-content-center min-vh-100">
        <div class="card mb-0 w-100 p-3 p-lg-2" style="background-image: url('{{ asset('assets/assets/images/auth/auth.jpg') }}');background-size: cover;background-position: center;">
            <div class="effect-one"></div>
            <div class="row g-0 align-items-center">
                <div class="col-xxl-8">
                    <div class="card auth-card border-0 shadow-none d-none d-sm-block mb-0 bg-transparent">
                        <div class="card-body p-5 d-flex justify-content-between flex-column h-100">
                            <div class="text-center mt-auto">
                                <p class="mb-0 mt-3 text-white">
                                    &copy;
                                    <script>document.write(new Date().getFullYear())</script>
                                    پنل مدیریت
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-4 mx-auto">
                    <div class="card shadow-lg border-none m-lg-5">
                        <div class="card-body">
                            <div class="p-2">
                                <div class="mb-4 pb-2 text-center mt-3">
                                    <a href="{{ url('/') }}" class="auth-logo">
                                        <img src="{{ asset('assets/assets/images/municipality_logo.jpg') }}" alt="{{ __('header.org_title') }}" height="90" class="auth-logo-dark mx-auto">
                                        <img src="{{ asset('assets/assets/images/municipality_logo.jpg') }}" alt="{{ __('header.org_title') }}" height="90" class="auth-logo-light mx-auto">
                                    </a>
                                </div>
                                <div class="error-img text-center px-5">
                                    <img src="{{ asset('assets/assets/images/auth/404-4.png') }}" class="img-fluid" alt="">
                                </div>
                                <div class="mt-4 text-center pt-3">
                                    <div class="position-relative">
                                        <h4 class="fs-2xl error-subtitle text-uppercase mb-0">اوه، صفحه پیدا نشد</h4>
                                        <p class="fs-base text-muted mt-3">صفحه‌ای که به دنبال آن هستید وجود ندارد یا منتقل شده است.</p>
                                        <div class="mt-4">
                                            <a href="{{ url('/') }}" class="btn btn-primary"><i class="mdi mdi-home me-1"></i>بازگشت به خانه</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="{{ asset('assets/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/assets/libs/simplebar/dist/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/assets/js/plugins.js') }}?v={{ filemtime(public_path('assets/assets/js/plugins.js')) }}"></script>
</body>

</html>
