@php
    $authUser = auth()->user();
@endphp

<div class="vertical-overlay"></div>
<div class="topbar-wrapper shadow">
    <header id="page-topbar">
        <div class="layout-width">
            <div class="navbar-header">
                <div class="d-flex">
                    <div class="navbar-brand-box horizontal-logo">
                        <a href="{{ route('dashboard') }}" class="logo logo-dark">
                            <span class="logo-sm">
                                <img src="{{ asset('assets/assets/images/logo-sm.png') }}" alt="" height="22">
                            </span>
                            <span class="logo-lg">
                                <img src="{{ asset('assets/assets/images/logo-dark.png') }}" alt="" height="22">
                            </span>
                        </a>

                        <a href="{{ route('dashboard') }}" class="logo logo-light">
                            <span class="logo-sm">
                                <img src="{{ asset('assets/assets/images/logo-sm.png') }}" alt="" height="22">
                            </span>
                            <span class="logo-lg">
                                <img src="{{ asset('assets/assets/images/logo-light.png') }}" alt="" height="22">
                            </span>
                        </a>
                    </div>

                    <div class="header-item flex-shrink-0 me-3 vertical-btn-wrapper">
                        <button type="button" class="btn btn-sm px-0 fs-xl vertical-menu-btn topnav-hamburger border hamburger-icon" id="topnav-hamburger-icon">
                            <i class="bx bx-chevrons-right arrow-right"></i>
                            <i class="bx bx-chevrons-left arrow-left"></i>
                        </button>
                    </div>

                    <h4 class="mb-sm-0 header-item page-title lh-base">@yield('page-title', 'داشبورد')</h4>
                </div>

                <div class="d-flex align-items-center">
                    <div class="dropdown d-none d-md-flex topbar-head-dropdown header-item">
                        <button type="button" class="btn btn-icon btn-topbar btn-ghost-dark rounded-circle" id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="bx bx-search fs-3xl"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-search-dropdown">
                            <form class="p-3">
                                <div class="form-group m-0">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="جستجو ..." aria-label="جستجو">
                                        <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="ms-1 header-item d-none d-sm-flex">
                        <button type="button" class="btn btn-icon btn-topbar btn-ghost-dark rounded-circle" data-toggle="fullscreen">
                            <i class="bx bx-fullscreen fs-3xl"></i>
                        </button>
                    </div>

                    <div class="dropdown topbar-head-dropdown ms-1 header-item">
                        <button type="button" class="btn btn-icon btn-topbar btn-ghost-dark rounded-circle mode-layout" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="bx bx-sun align-middle fs-3xl"></i>
                        </button>
                        <div class="dropdown-menu p-2 dropdown-menu-end" id="light-dark-mode">
                            <a href="#!" class="dropdown-item" data-mode="light"><i class="bx bx-sun align-middle me-2"></i> پیش‌فرض (حالت روشن)</a>
                            <a href="#!" class="dropdown-item" data-mode="dark"><i class="bx bx-moon align-middle me-2"></i> تاریک</a>
                            <a href="#!" class="dropdown-item" data-mode="auto"><i class="bx bx-desktop align-middle me-2"></i> خودکار (پیش‌فرض سیستم)</a>
                        </div>
                    </div>

                    <div class="dropdown ms-sm-3 header-item topbar-user">
                        <button type="button" class="btn shadow-none" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="d-flex align-items-center">
                                <img class="rounded-circle header-profile-user" src="{{ asset('assets/assets/images/users/32/avatar-1.jpg') }}" alt="Header Avatar">
                                <span class="text-start ms-xl-2">
                                    <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">
                                        {{ $authUser?->name ?? 'کاربر' }} {{ $authUser?->last_name }}
                                    </span>
                                    <span class="d-none d-xl-block ms-1 fs-sm user-name-sub-text">
                                        {{ $authUser?->username ?? 'مهمان' }}
                                    </span>
                                </span>
                            </span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <h6 class="dropdown-header">خوش آمدید {{ $authUser?->name ?? '' }}</h6>
                            @auth
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="mdi mdi-logout text-muted fs-lg align-middle me-1"></i>
                                        <span class="align-middle">خروج</span>
                                    </button>
                                </form>
                            @else
                                <a class="dropdown-item" href="{{ route('login') }}">
                                    <i class="mdi mdi-login text-muted fs-lg align-middle me-1"></i>
                                    <span class="align-middle">ورود</span>
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
</div>
