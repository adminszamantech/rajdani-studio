<div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
    <a class="navbar-brand brand-logo" href="{{ route('dashboard') }}"><img src="@if(website()->logo_image) {{ asset('/storage/admin/assets/images/logo/'.website()->logo_image) }} @else {{ asset('/storage/admin/assets/images/logo.svg') }} @endif" alt="logo" /></a>
    <a class="navbar-brand brand-logo-mini" href="{{ route('dashboard') }}"><img src="{{ asset('/storage/admin/assets/images/logo-mini.svg') }}" alt="logo" /></a>
  </div>
  <div class="navbar-menu-wrapper d-flex align-items-stretch">
    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
      <span class="mdi mdi-menu"></span>
    </button>
    <ul class="navbar-nav navbar-nav-right">
        <li class="nav-item d-none d-lg-block full-screen-link">
        <a class="nav-link">
          <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
        </a>
      </li>
      <li class="nav-item nav-profile dropdown">
        <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
          <div class="nav-profile-img">
            <img src="@if(website()->logo_image) {{ asset('/storage/admin/assets/images/logo/'.website()->logo_image) }} @else {{ asset('/storage/admin/assets/images/faces/face1.jpg') }} @endif" alt="image">
            <span class="availability-status online"></span>
          </div>
          <div class="nav-profile-text">
            <p class="mb-1 text-black">{{ Auth::user()->name ?? 'Admin' }}</p>
          </div>
        </a>
        <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
          <a class="dropdown-item" href="{{ route('profileSetting') }}">
            <i class="mdi mdi-cached me-2 text-success"></i> Profile Settings </a>
          <div class="dropdown-divider"></div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a class="dropdown-item" :href="route('logout')"
                onclick="event.preventDefault();
                            this.closest('form').submit();">
                  <i class="mdi mdi-logout me-2 text-primary"></i> Signout </a>
            </form>
        </div>
      </li>

    </ul>
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
      <span class="mdi mdi-menu"></span>
    </button>
  </div>
