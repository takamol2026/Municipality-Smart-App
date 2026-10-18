<!doctype html>
<html lang="fa" data-layout="vertical" data-sidebar="dark" data-sidebar-image="img-1" data-sidebar-size="lg" data-preloader="disable" data-theme="default" dir="rtl" data-topbar="light" data-bs-theme="light" data-theme-color="0">

<head>
    <meta charset="utf-8">
    <title>ورود | پنل مدیریت</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
    <section class="auth-page-wrapper p-2 p-lg-4 position-relative d-flex align-items-center justify-content-center min-vh-100">
        <div class="card mb-0 w-100 p-3 p-lg-2" style="background-image: url('{{ asset('assets/assets/images/auth/auth.jpg') }}');background-size: cover;background-position: center;">
            <div class="effect-one"></div>
            <div class="row g-0 align-items-center">
                <div class="col-xxl-8 order-last order-xl-first">
                    <div class="card auth-card border-0 shadow-none mb-0 bg-transparent">
                        <div class="card-body p-4 p-xl-5 d-flex justify-content-between flex-column h-100">
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
                <div class="col-lg-8 col-xxl-4 mx-auto order-first order-xl-last">
                    <div class="card shadow-lg border-none m-lg-5">
                        <div class="card-body">
                            <div class="text-center mt-4">
                                <div class="mb-4 pb-2">
                                    <a href="{{ url('/') }}" class="auth-logo">
                                        <img src="{{ asset('assets/assets/images/municipality_logo.jpg') }}" alt="{{ __('header.org_title') }}" height="90" class="auth-logo-dark mx-auto">
                                        <img src="{{ asset('assets/assets/images/municipality_logo.jpg') }}" alt="{{ __('header.org_title') }}" height="90" class="auth-logo-light mx-auto">
                                    </a>
                                </div>
                                <h5 class="fs-3xl">خوش آمدید</h5>
                                <p class="text-muted">برای ادامه وارد شوید.</p>
                            </div>
                            <div class="p-2 mt-4">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">{{ session('status') }}</div>
                                @endif

                                <form method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="login" class="form-label">ایمیل یا نام کاربری <span class="text-danger">*</span></label>
                                        <input
                                            type="text"
                                            class="form-control @error('login') is-invalid @enderror"
                                            id="login"
                                            name="login"
                                            value="{{ old('login') }}"
                                            placeholder="ایمیل یا نام کاربری را وارد کنید"
                                            autocomplete="username"
                                            autofocus
                                            required
                                        >
                                        @error('login')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <div class="float-end">
                                            <a href="{{ route('password.request') }}" class="text-muted">رمز عبور را فراموش کرده‌اید؟</a>
                                        </div>
                                        <label class="form-label" for="password-input">رمز عبور <span class="text-danger">*</span></label>
                                        <div class="position-relative auth-pass-inputgroup mb-3">
                                            <input
                                                type="password"
                                                class="form-control pe-5 password-input @error('password') is-invalid @enderror"
                                                placeholder="رمز عبور را وارد کنید"
                                                id="password-input"
                                                name="password"
                                                autocomplete="current-password"
                                                required
                                            >
                                            <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon">
                                                <i class="ri-eye-fill align-middle"></i>
                                            </button>
                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" value="1" id="auth-remember-check" @checked(old('remember'))>
                                        <label class="form-check-label" for="auth-remember-check">مرا به خاطر بسپار</label>
                                    </div>

                                    <div class="mt-4">
                                        <button class="btn btn-primary w-100" type="submit">ورود</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="{{ asset('assets/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/assets/libs/simplebar/dist/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/assets/js/plugins.js') }}"></script>
    <script src="{{ asset('assets/assets/js/pages/password-addon.init.js') }}"></script>
</body>

</html>
