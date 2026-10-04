@php
    $isActive = fn (string $prefix) => request()->is($prefix) || request()->is($prefix.'/*');
    $authUser = auth()->user();
@endphp

<div class="app-menu navbar-menu">
    <div class="navbar-brand-box">
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
        <button type="button" class="btn btn-sm p-0 fs-3xl header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
        <div class="vertical-menu-btn-wrapper header-item vertical-icon">
            <button type="button" class="btn btn-sm px-0 fs-xl vertical-menu-btn topnav-hamburger shadow hamburger-icon" id="topnav-hamburger-icon">
                <i class="bx bx-chevrons-right"></i>
                <i class="bx bx-chevrons-left"></i>
            </button>
        </div>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">
            <div id="two-column-menu"></div>

            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span>منو</span></li>

                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link menu-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="bx bx-home-alt"></i> <span>داشبورد</span>
                    </a>
                </li>

                {{-- کاربران --}}
                <li class="nav-item">
                    <a href="#sidebarUsers" class="nav-link menu-link {{ $isActive('users') ? '' : 'collapsed' }}"
                       data-bs-toggle="collapse" role="button"
                       aria-expanded="{{ $isActive('users') ? 'true' : 'false' }}"
                       aria-controls="sidebarUsers">
                        <i class="bx bx-user-circle"></i> <span>کاربران</span>
                    </a>
                    <div class="collapse menu-dropdown {{ $isActive('users') ? 'show' : '' }}" id="sidebarUsers">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('users.index') }}" class="nav-link {{ request()->routeIs('users.index') ? 'active' : '' }}">لیست کاربران</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('users.create') }}" class="nav-link {{ request()->routeIs('users.create') ? 'active' : '' }}">افزودن کاربر</a>
                            </li>
                        </ul>
                    </div>
                </li>

                {{-- مناطق --}}
                <li class="nav-item">
                    <a href="#sidebarDistricts" class="nav-link menu-link {{ $isActive('districts') ? '' : 'collapsed' }}"
                       data-bs-toggle="collapse" role="button"
                       aria-expanded="{{ $isActive('districts') ? 'true' : 'false' }}"
                       aria-controls="sidebarDistricts">
                        <i class="bx bx-map-alt"></i> <span>مناطق</span>
                    </a>
                    <div class="collapse menu-dropdown {{ $isActive('districts') ? 'show' : '' }}" id="sidebarDistricts">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('districts.index') }}" class="nav-link {{ request()->routeIs('districts.index') ? 'active' : '' }}">لیست مناطق</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('districts.create') }}" class="nav-link {{ request()->routeIs('districts.create') ? 'active' : '' }}">افزودن منطقه</a>
                            </li>
                        </ul>
                    </div>
                </li>

                {{-- خدمات شهری --}}
                <li class="nav-item">
                    <a href="#sidebarUrbanServices" class="nav-link menu-link {{ $isActive('urban-service-categories') || $isActive('urban-services') ? '' : 'collapsed' }}"
                       data-bs-toggle="collapse" role="button"
                       aria-expanded="{{ $isActive('urban-service-categories') || $isActive('urban-services') ? 'true' : 'false' }}"
                       aria-controls="sidebarUrbanServices">
                        <i class="bx bx-buildings"></i> <span>خدمات شهری</span>
                    </a>
                    <div class="collapse menu-dropdown {{ $isActive('urban-service-categories') || $isActive('urban-services') ? 'show' : '' }}" id="sidebarUrbanServices">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ url('urban-service-categories') }}" class="nav-link {{ $isActive('urban-service-categories') ? 'active' : '' }}">دسته‌بندی‌ها</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('urban-services') }}" class="nav-link {{ $isActive('urban-services') ? 'active' : '' }}">خدمات</a>
                            </li>
                        </ul>
                    </div>
                </li>

                {{-- جاذبه‌های تاریخی --}}
                <li class="nav-item">
                    <a href="#sidebarHistorical" class="nav-link menu-link {{ $isActive('historical-attraction-categories') || $isActive('historical-attractions') ? '' : 'collapsed' }}"
                       data-bs-toggle="collapse" role="button"
                       aria-expanded="{{ $isActive('historical-attraction-categories') || $isActive('historical-attractions') ? 'true' : 'false' }}"
                       aria-controls="sidebarHistorical">
                        <i class="bx bx-history"></i> <span>جاذبه‌های تاریخی</span>
                    </a>
                    <div class="collapse menu-dropdown {{ $isActive('historical-attraction-categories') || $isActive('historical-attractions') ? 'show' : '' }}" id="sidebarHistorical">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ url('historical-attraction-categories') }}" class="nav-link {{ $isActive('historical-attraction-categories') ? 'active' : '' }}">دسته‌بندی‌ها</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('historical-attractions') }}" class="nav-link {{ $isActive('historical-attractions') ? 'active' : '' }}">جاذبه‌ها</a>
                            </li>
                        </ul>
                    </div>
                </li>

                {{-- علما --}}
                <li class="nav-item">
                    <a href="#sidebarScholars" class="nav-link menu-link {{ $isActive('scholars') ? '' : 'collapsed' }}"
                       data-bs-toggle="collapse" role="button"
                       aria-expanded="{{ $isActive('scholars') ? 'true' : 'false' }}"
                       aria-controls="sidebarScholars">
                        <i class="bx bx-book-reader"></i> <span>علما</span>
                    </a>
                    <div class="collapse menu-dropdown {{ $isActive('scholars') ? 'show' : '' }}" id="sidebarScholars">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('scholars.index') }}" class="nav-link {{ request()->routeIs('scholars.index') ? 'active' : '' }}">لیست علما</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('scholars.create') }}" class="nav-link {{ request()->routeIs('scholars.create') ? 'active' : '' }}">افزودن عالم</a>
                            </li>
                        </ul>
                    </div>
                </li>

                {{-- اطلاعیه‌ها --}}
                <li class="nav-item">
                    <a href="#sidebarAnnouncements" class="nav-link menu-link {{ $isActive('announcement-categories') || $isActive('announcements') ? '' : 'collapsed' }}"
                       data-bs-toggle="collapse" role="button"
                       aria-expanded="{{ $isActive('announcement-categories') || $isActive('announcements') ? 'true' : 'false' }}"
                       aria-controls="sidebarAnnouncements">
                        <i class="bx bx-news"></i> <span>اطلاعیه‌ها</span>
                    </a>
                    <div class="collapse menu-dropdown {{ $isActive('announcement-categories') || $isActive('announcements') ? 'show' : '' }}" id="sidebarAnnouncements">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ url('announcement-categories') }}" class="nav-link {{ $isActive('announcement-categories') ? 'active' : '' }}">دسته‌بندی‌ها</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('announcements') }}" class="nav-link {{ $isActive('announcements') ? 'active' : '' }}">اطلاعیه‌ها</a>
                            </li>
                        </ul>
                    </div>
                </li>

                {{-- پروژه‌ها --}}
                <li class="nav-item">
                    <a href="#sidebarProjects" class="nav-link menu-link {{ $isActive('project-categories') || $isActive('projects') || $isActive('project-media') ? '' : 'collapsed' }}"
                       data-bs-toggle="collapse" role="button"
                       aria-expanded="{{ $isActive('project-categories') || $isActive('projects') || $isActive('project-media') ? 'true' : 'false' }}"
                       aria-controls="sidebarProjects">
                        <i class="bx bx-briefcase"></i> <span>پروژه‌ها</span>
                    </a>
                    <div class="collapse menu-dropdown {{ $isActive('project-categories') || $isActive('projects') || $isActive('project-media') ? 'show' : '' }}" id="sidebarProjects">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ url('project-categories') }}" class="nav-link {{ $isActive('project-categories') ? 'active' : '' }}">دسته‌بندی‌ها</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('projects') }}" class="nav-link {{ $isActive('projects') ? 'active' : '' }}">پروژه‌ها</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('project-media') }}" class="nav-link {{ $isActive('project-media') ? 'active' : '' }}">رسانه‌ها</a>
                            </li>
                        </ul>
                    </div>
                </li>

                {{-- نقشه --}}
                <li class="nav-item">
                    <a href="#sidebarMap" class="nav-link menu-link {{ $isActive('map-categories') || $isActive('map-locations') || $isActive('map-media') ? '' : 'collapsed' }}"
                       data-bs-toggle="collapse" role="button"
                       aria-expanded="{{ $isActive('map-categories') || $isActive('map-locations') || $isActive('map-media') ? 'true' : 'false' }}"
                       aria-controls="sidebarMap">
                        <i class="bx bx-map"></i> <span>نقشه</span>
                    </a>
                    <div class="collapse menu-dropdown {{ $isActive('map-categories') || $isActive('map-locations') || $isActive('map-media') ? 'show' : '' }}" id="sidebarMap">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ url('map-categories') }}" class="nav-link {{ $isActive('map-categories') ? 'active' : '' }}">دسته‌بندی‌ها</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('map-locations') }}" class="nav-link {{ $isActive('map-locations') ? 'active' : '' }}">مکان‌ها</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('map-media') }}" class="nav-link {{ $isActive('map-media') ? 'active' : '' }}">رسانه‌ها</a>
                            </li>
                        </ul>
                    </div>
                </li>

                {{-- اجاره --}}
                <li class="nav-item">
                    <a href="#sidebarRentals" class="nav-link menu-link {{ $isActive('rental-categories') || $isActive('rentals') ? '' : 'collapsed' }}"
                       data-bs-toggle="collapse" role="button"
                       aria-expanded="{{ $isActive('rental-categories') || $isActive('rentals') ? 'true' : 'false' }}"
                       aria-controls="sidebarRentals">
                        <i class="bx bx-store"></i> <span>اجاره</span>
                    </a>
                    <div class="collapse menu-dropdown {{ $isActive('rental-categories') || $isActive('rentals') ? 'show' : '' }}" id="sidebarRentals">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ url('rental-categories') }}" class="nav-link {{ $isActive('rental-categories') ? 'active' : '' }}">دسته‌بندی‌ها</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('rentals') }}" class="nav-link {{ $isActive('rentals') ? 'active' : '' }}">موارد اجاره</a>
                            </li>
                        </ul>
                    </div>
                </li>

                {{-- صفایی --}}
                <li class="nav-item">
                    <a href="#sidebarSafaei" class="nav-link menu-link {{ $isActive('safaei-categories') || $isActive('safaei') ? '' : 'collapsed' }}"
                       data-bs-toggle="collapse" role="button"
                       aria-expanded="{{ $isActive('safaei-categories') || $isActive('safaei') ? 'true' : 'false' }}"
                       aria-controls="sidebarSafaei">
                        <i class="bx bx-folder"></i> <span>صفایی</span>
                    </a>
                    <div class="collapse menu-dropdown {{ $isActive('safaei-categories') || $isActive('safaei') ? 'show' : '' }}" id="sidebarSafaei">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ url('safaei-categories') }}" class="nav-link {{ $isActive('safaei-categories') ? 'active' : '' }}">دسته‌بندی‌ها</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('safaei') }}" class="nav-link {{ $isActive('safaei') ? 'active' : '' }}">فایل‌ها</a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>

    <div class="dropdown sidebar-user mt-4">
        <button type="button" class="btn sidebar-user-button shadow-none w-100" id="sidebar-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="d-flex align-items-center overflow-hidden">
                <img class="rounded-circle header-profile-user" src="{{ asset('assets/assets/images/users/32/avatar-1.jpg') }}" alt="Header Avatar">
                <span class="text-start ms-xl-2 overflow-hidden flex-grow-1 sideba-user-content">
                    <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text text-truncate mb-0">
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

    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
