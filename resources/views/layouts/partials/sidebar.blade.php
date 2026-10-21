@php
    $isActive = fn (string $prefix) => request()->is($prefix) || request()->is($prefix.'/*');
    $groupActive = function (array $prefixes) use ($isActive): bool {
        foreach ($prefixes as $prefix) {
            if ($isActive($prefix)) {
                return true;
            }
        }

        return false;
    };
    $authUser = auth()->user();
@endphp

<div class="app-menu navbar-menu">
    <div class="navbar-brand-box">
        <a href="{{ route('dashboard') }}" class="sidebar-brand-link">
            <span class="sidebar-brand">
                <span class="sidebar-brand-line">{{ __('header.sidebar_brand_line1') }}</span>
                <span class="sidebar-brand-line is-emphasis">{{ __('header.sidebar_brand_line2') }}</span>
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
                <li class="menu-title"><span>{{ __('sidebar.menu') }}</span></li>

                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link menu-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="bx bx-home-alt"></i> <span>{{ __('sidebar.dashboard') }}</span>
                    </a>
                </li>

                {{-- مناطق --}}
                <li class="nav-item">
                    <a href="#sidebarDistricts" class="nav-link menu-link {{ $isActive('districts') ? '' : 'collapsed' }}"
                       data-bs-toggle="collapse" role="button"
                       aria-expanded="{{ $isActive('districts') ? 'true' : 'false' }}"
                       aria-controls="sidebarDistricts">
                        <i class="bx bx-map-alt"></i> <span>{{ __('sidebar.districts') }}</span>
                    </a>
                    <div class="collapse menu-dropdown {{ $isActive('districts') ? 'show' : '' }}" id="sidebarDistricts">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('districts.create') }}" class="nav-link {{ request()->routeIs('districts.create') ? 'active' : '' }}">{{ __('sidebar.districts_create') }}</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('districts.index') }}" class="nav-link {{ request()->routeIs('districts.index') ? 'active' : '' }}">{{ __('sidebar.districts_list') }}</a>
                            </li>
                        </ul>
                    </div>
                </li>

                {{-- خدمات شهری --}}
                @php $urbanOpen = $groupActive(['urban-services', 'urban-service-categories']); @endphp
                <li class="nav-item">
                    <a href="#sidebarUrbanServices" class="nav-link menu-link {{ $urbanOpen ? '' : 'collapsed' }}"
                       data-bs-toggle="collapse" role="button"
                       aria-expanded="{{ $urbanOpen ? 'true' : 'false' }}"
                       aria-controls="sidebarUrbanServices">
                        <i class="bx bx-buildings"></i> <span>{{ __('sidebar.urban_services') }}</span>
                    </a>
                    <div class="collapse menu-dropdown {{ $urbanOpen ? 'show' : '' }}" id="sidebarUrbanServices">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('urban-services.create') }}" class="nav-link {{ request()->routeIs('urban-services.create') ? 'active' : '' }}">{{ __('sidebar.services_create') }}</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('urban-services.index') }}" class="nav-link {{ request()->routeIs('urban-services.index') ? 'active' : '' }}">{{ __('sidebar.services_list') }}</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('urban-service-categories.create') }}" class="nav-link {{ request()->routeIs('urban-service-categories.create') ? 'active' : '' }}">{{ __('sidebar.categories_create') }}</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('urban-service-categories.index') }}" class="nav-link {{ request()->routeIs('urban-service-categories.index') ? 'active' : '' }}">{{ __('sidebar.categories') }}</a>
                            </li>
                        </ul>
                    </div>
                </li>

                {{-- جاذبه‌های تاریخی --}}
                @php $historicalOpen = $groupActive(['historical-attractions', 'historical-attraction-categories']); @endphp
                <li class="nav-item">
                    <a href="#sidebarHistorical" class="nav-link menu-link {{ $historicalOpen ? '' : 'collapsed' }}"
                       data-bs-toggle="collapse" role="button"
                       aria-expanded="{{ $historicalOpen ? 'true' : 'false' }}"
                       aria-controls="sidebarHistorical">
                        <i class="bx bx-history"></i> <span>{{ __('sidebar.historical') }}</span>
                    </a>
                    <div class="collapse menu-dropdown {{ $historicalOpen ? 'show' : '' }}" id="sidebarHistorical">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('historical-attractions.create') }}" class="nav-link {{ request()->routeIs('historical-attractions.create') ? 'active' : '' }}">{{ __('sidebar.attractions_create') }}</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('historical-attractions.index') }}" class="nav-link {{ request()->routeIs('historical-attractions.index') ? 'active' : '' }}">{{ __('sidebar.attractions_list') }}</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('historical-attraction-categories.create') }}" class="nav-link {{ request()->routeIs('historical-attraction-categories.create') ? 'active' : '' }}">{{ __('sidebar.categories_create') }}</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('historical-attraction-categories.index') }}" class="nav-link {{ request()->routeIs('historical-attraction-categories.index') ? 'active' : '' }}">{{ __('sidebar.categories') }}</a>
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
                        <i class="bx bx-book-reader"></i> <span>{{ __('sidebar.scholars') }}</span>
                    </a>
                    <div class="collapse menu-dropdown {{ $isActive('scholars') ? 'show' : '' }}" id="sidebarScholars">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('scholars.create') }}" class="nav-link {{ request()->routeIs('scholars.create') ? 'active' : '' }}">{{ __('sidebar.scholars_create') }}</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('scholars.index') }}" class="nav-link {{ request()->routeIs('scholars.index') ? 'active' : '' }}">{{ __('sidebar.scholars_list') }}</a>
                            </li>
                        </ul>
                    </div>
                </li>

                {{-- اطلاعیه‌ها --}}
                @php $announcementsOpen = $groupActive(['announcements', 'announcement-categories']); @endphp
                <li class="nav-item">
                    <a href="#sidebarAnnouncements" class="nav-link menu-link {{ $announcementsOpen ? '' : 'collapsed' }}"
                       data-bs-toggle="collapse" role="button"
                       aria-expanded="{{ $announcementsOpen ? 'true' : 'false' }}"
                       aria-controls="sidebarAnnouncements">
                        <i class="bx bx-news"></i> <span>{{ __('sidebar.announcements') }}</span>
                    </a>
                    <div class="collapse menu-dropdown {{ $announcementsOpen ? 'show' : '' }}" id="sidebarAnnouncements">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('announcements.create') }}" class="nav-link {{ request()->routeIs('announcements.create') ? 'active' : '' }}">{{ __('sidebar.announcements_create') }}</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('announcements.index') }}" class="nav-link {{ request()->routeIs('announcements.index') ? 'active' : '' }}">{{ __('sidebar.announcements_list') }}</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('announcement-categories.create') }}" class="nav-link {{ request()->routeIs('announcement-categories.create') ? 'active' : '' }}">{{ __('sidebar.categories_create') }}</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('announcement-categories.index') }}" class="nav-link {{ request()->routeIs('announcement-categories.index') ? 'active' : '' }}">{{ __('sidebar.categories') }}</a>
                            </li>
                        </ul>
                    </div>
                </li>

                {{-- پروژه‌ها --}}
                @php $projectsOpen = $groupActive(['projects', 'project-categories']); @endphp
                <li class="nav-item">
                    <a href="#sidebarProjects" class="nav-link menu-link {{ $projectsOpen ? '' : 'collapsed' }}"
                       data-bs-toggle="collapse" role="button"
                       aria-expanded="{{ $projectsOpen ? 'true' : 'false' }}"
                       aria-controls="sidebarProjects">
                        <i class="bx bx-briefcase"></i> <span>{{ __('sidebar.projects') }}</span>
                    </a>
                    <div class="collapse menu-dropdown {{ $projectsOpen ? 'show' : '' }}" id="sidebarProjects">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('projects.create') }}" class="nav-link {{ request()->routeIs('projects.create') ? 'active' : '' }}">{{ __('sidebar.projects_create') }}</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('projects.index') }}" class="nav-link {{ request()->routeIs('projects.index') ? 'active' : '' }}">{{ __('sidebar.projects_list') }}</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('project-categories.create') }}" class="nav-link {{ request()->routeIs('project-categories.create') ? 'active' : '' }}">{{ __('sidebar.categories_create') }}</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('project-categories.index') }}" class="nav-link {{ request()->routeIs('project-categories.index') ? 'active' : '' }}">{{ __('sidebar.categories') }}</a>
                            </li>
                        </ul>
                    </div>
                </li>

                {{-- نقشه --}}
                @php $mapOpen = $groupActive(['map-locations', 'map-categories']); @endphp
                <li class="nav-item">
                    <a href="#sidebarMapLocations" class="nav-link menu-link {{ $mapOpen ? '' : 'collapsed' }}"
                       data-bs-toggle="collapse" role="button"
                       aria-expanded="{{ $mapOpen ? 'true' : 'false' }}"
                       aria-controls="sidebarMapLocations">
                        <i class="bx bx-map"></i> <span>{{ __('sidebar.map') }}</span>
                    </a>
                    <div class="collapse menu-dropdown {{ $mapOpen ? 'show' : '' }}" id="sidebarMapLocations">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('map-locations.create') }}" class="nav-link {{ request()->routeIs('map-locations.create') ? 'active' : '' }}">{{ __('sidebar.locations_create') }}</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('map-locations.index') }}" class="nav-link {{ request()->routeIs('map-locations.index') ? 'active' : '' }}">{{ __('sidebar.locations_list') }}</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('map-categories.create') }}" class="nav-link {{ request()->routeIs('map-categories.create') ? 'active' : '' }}">{{ __('sidebar.categories_create') }}</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('map-categories.index') }}" class="nav-link {{ request()->routeIs('map-categories.index') ? 'active' : '' }}">{{ __('sidebar.categories') }}</a>
                            </li>
                        </ul>
                    </div>
                </li>

                {{-- اجاره --}}
                @php $rentalsOpen = $groupActive(['rentals', 'rental-categories']); @endphp
                <li class="nav-item">
                    <a href="#sidebarRentals" class="nav-link menu-link {{ $rentalsOpen ? '' : 'collapsed' }}"
                       data-bs-toggle="collapse" role="button"
                       aria-expanded="{{ $rentalsOpen ? 'true' : 'false' }}"
                       aria-controls="sidebarRentals">
                        <i class="bx bx-store"></i> <span>{{ __('sidebar.rentals') }}</span>
                    </a>
                    <div class="collapse menu-dropdown {{ $rentalsOpen ? 'show' : '' }}" id="sidebarRentals">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('rentals.create') }}" class="nav-link {{ request()->routeIs('rentals.create') ? 'active' : '' }}">{{ __('sidebar.rentals_create') }}</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('rentals.index') }}" class="nav-link {{ request()->routeIs('rentals.index') ? 'active' : '' }}">{{ __('sidebar.rentals_list') }}</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('rental-categories.create') }}" class="nav-link {{ request()->routeIs('rental-categories.create') ? 'active' : '' }}">{{ __('sidebar.categories_create') }}</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('rental-categories.index') }}" class="nav-link {{ request()->routeIs('rental-categories.index') ? 'active' : '' }}">{{ __('sidebar.categories') }}</a>
                            </li>
                        </ul>
                    </div>
                </li>

                {{-- صفایی --}}
                @php $safaeiOpen = $groupActive(['safaei', 'safaei-categories']); @endphp
                <li class="nav-item">
                    <a href="#sidebarSafaei" class="nav-link menu-link {{ $safaeiOpen ? '' : 'collapsed' }}"
                       data-bs-toggle="collapse" role="button"
                       aria-expanded="{{ $safaeiOpen ? 'true' : 'false' }}"
                       aria-controls="sidebarSafaei">
                        <i class="bx bx-folder"></i> <span>{{ __('sidebar.safaei') }}</span>
                    </a>
                    <div class="collapse menu-dropdown {{ $safaeiOpen ? 'show' : '' }}" id="sidebarSafaei">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('safaei.create') }}" class="nav-link {{ request()->routeIs('safaei.create') ? 'active' : '' }}">{{ __('sidebar.files_create') }}</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('safaei.index') }}" class="nav-link {{ request()->routeIs('safaei.index') ? 'active' : '' }}">{{ __('sidebar.files_list') }}</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('safaei-categories.create') }}" class="nav-link {{ request()->routeIs('safaei-categories.create') ? 'active' : '' }}">{{ __('sidebar.categories_create') }}</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('safaei-categories.index') }}" class="nav-link {{ request()->routeIs('safaei-categories.index') ? 'active' : '' }}">{{ __('sidebar.categories') }}</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a href="{{ route('complaints.index') }}" class="nav-link menu-link {{ request()->routeIs('complaints.index') ? 'active' : '' }}">
                        <i class="bx bx-message-error"></i> <span>{{ __('sidebar.complaints') }}</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('suggestions.index') }}" class="nav-link menu-link {{ request()->routeIs('suggestions.index') ? 'active' : '' }}">
                        <i class="bx bx-bulb"></i> <span>{{ __('sidebar.suggestions') }}</span>
                    </a>
                </li>

                <li class="menu-title"><span>{{ __('sidebar.management') }}</span></li>

                {{-- ثبت کاربران --}}
                <li class="nav-item">
                    <a href="#sidebarUsers" class="nav-link menu-link {{ $isActive('users') ? '' : 'collapsed' }}"
                       data-bs-toggle="collapse" role="button"
                       aria-expanded="{{ $isActive('users') ? 'true' : 'false' }}"
                       aria-controls="sidebarUsers">
                        <i class="bx bx-user-circle"></i> <span>{{ __('sidebar.users') }}</span>
                    </a>
                    <div class="collapse menu-dropdown {{ $isActive('users') ? 'show' : '' }}" id="sidebarUsers">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('users.create') }}" class="nav-link {{ request()->routeIs('users.create') ? 'active' : '' }}">{{ __('sidebar.users_create') }}</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('users.index') }}" class="nav-link {{ request()->routeIs('users.index') ? 'active' : '' }}">{{ __('sidebar.users_list') }}</a>
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
                <span class="text-start overflow-hidden flex-grow-1 sideba-user-content">
                    <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text text-truncate mb-0">
                        {{ $authUser?->name ?? __('header.user') }} {{ $authUser?->last_name }}
                    </span>
                    <span class="d-none d-xl-block ms-1 fs-sm user-name-sub-text">
                        {{ $authUser?->username ?? __('header.guest') }}
                    </span>
                </span>
            </span>
        </button>
        <div class="dropdown-menu dropdown-menu-end">
            <h6 class="dropdown-header">{{ __('header.welcome') }} {{ $authUser?->name ?? '' }}</h6>
            @include('layouts.partials.user-dropdown')
        </div>
    </div>

    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->

<style>
    .app-menu .navbar-brand-box {
        height: auto;
        padding: 18px 16px 14px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
    }
    .sidebar-brand-link {
        display: block;
        line-height: 1.4;
        text-decoration: none;
    }
    .sidebar-brand {
        display: block;
        text-align: center;
        white-space: normal;
    }
    .sidebar-brand-line {
        display: block;
        color: rgba(255, 255, 255, 0.82);
        font-size: 12px;
        font-weight: 500;
        line-height: 1.7;
    }
    .sidebar-brand-line.is-emphasis {
        color: #fff;
        font-size: 13.5px;
        font-weight: 700;
        margin-top: 2px;
    }

    @media (min-width: 768px) {
        html[data-layout="vertical"][data-sidebar-size="sm"],
        html[data-layout="vertical"][data-sidebar-size="sm"] #layout-wrapper,
        html[data-layout="vertical"][data-sidebar-size="sm"] .main-content {
            min-height: 100vh !important;
        }
    }

    html[data-sidebar-size="sm"] .app-menu .navbar-brand-box {
        height: var(--tb-header-height);
        padding: 0;
        overflow: hidden;
    }

    html[data-sidebar-size="sm"] .sidebar-brand {
        display: none;
    }
</style>
