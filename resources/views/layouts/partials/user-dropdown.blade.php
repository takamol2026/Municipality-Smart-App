@auth
    <a class="dropdown-item" href="{{ route('profile.edit') }}">
        <i class="mdi mdi-account-edit text-muted fs-lg align-middle me-1"></i>
        <span class="align-middle">{{ __('header.edit_profile') }}</span>
    </a>
    <a class="dropdown-item" href="{{ route('profile.edit') }}#password">
        <i class="mdi mdi-lock-reset text-muted fs-lg align-middle me-1"></i>
        <span class="align-middle">{{ __('header.change_password') }}</span>
    </a>
    <div class="dropdown-divider"></div>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="dropdown-item">
            <i class="mdi mdi-logout text-muted fs-lg align-middle me-1"></i>
            <span class="align-middle">{{ __('header.logout') }}</span>
        </button>
    </form>
@else
    <a class="dropdown-item" href="{{ route('login') }}">
        <i class="mdi mdi-login text-muted fs-lg align-middle me-1"></i>
        <span class="align-middle">{{ __('header.login') }}</span>
    </a>
@endauth
