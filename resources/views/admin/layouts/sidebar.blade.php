<ul class="nav">
    <li class="nav-item nav-profile">
        <a href="{{ route('dashboard') }}" class="nav-link">
            <div class="nav-profile-image">
                <img src="{{ asset('/storage/admin/assets/images/faces/face1.jpg') }}" alt="profile" />
                <span class="login-status online"></span>
            </div>
            <div class="nav-profile-text d-flex flex-column">
                <span class="font-weight-bold mb-2">{{ Auth::user()->name ?? 'Admin' }}</span>
                <span class="text-secondary text-small">Logged In</span>
            </div>
            <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <span class="menu-title">Dashboard</span>
            <i class="mdi mdi-home menu-icon"></i>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#sliders" aria-expanded="false" aria-controls="sliders">
            <span class="menu-title">Slider Pages</span>
            <i class="menu-arrow"></i>
            <i class="mdi mdi-format-list-bulleted menu-icon"></i>
        </a>
        <div class="collapse" id="sliders">
            <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('sliders.index') }}">Lists</a>
                </li>
            </ul>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#projects" aria-expanded="false" aria-controls="projects">
            <span class="menu-title">Project Pages</span>
            <i class="menu-arrow"></i>
            <i class="mdi mdi-format-list-bulleted menu-icon"></i>
        </a>
        <div class="collapse" id="projects">
            <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('projects.index') }}">Lists</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('project-categories.index') }}">Project Categories</a>
                </li>
            </ul>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#aboutus" aria-expanded="false" aria-controls="aboutus">
            <span class="menu-title">About Pages</span>
            <i class="menu-arrow"></i>
            <i class="mdi mdi-format-list-bulleted menu-icon"></i>
        </a>
        <div class="collapse" id="aboutus">
            <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('profiles.index') }}">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('messages.index') }}">Message</a>
                </li>
            </ul>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#jobpost" aria-expanded="false" aria-controls="jobpost">
            <span class="menu-title">Job Posts</span>
            <i class="menu-arrow"></i>
            <i class="mdi mdi-format-list-bulleted menu-icon"></i>
        </a>
        <div class="collapse" id="jobpost">
            <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('job-posts.index') }}">Lists</a>
                </li>
            </ul>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#contactus" aria-expanded="false" aria-controls="contactus">
            <span class="menu-title">Contact Pages</span>
            <i class="menu-arrow"></i>
            <i class="mdi mdi-format-list-bulleted menu-icon"></i>
        </a>
        <div class="collapse" id="contactus">
            <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('contacts.index') }}">Lists</a>
                </li>
            </ul>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#settings" aria-expanded="false"
            aria-controls="settings">
            <span class="menu-title">Settings</span>
            <i class="menu-arrow"></i>
            <i class="mdi mdi-format-list-bulleted menu-icon"></i>
        </a>
        <div class="collapse" id="settings">
            <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('websiteSetting') }}">Website Settings</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('profileSetting') }}">Profile Settings</a>
                </li>
            </ul>
        </div>
    </li>
    <li class="nav-item">
        <a href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link">
            <span class="menu-title">Signout</span>
            <i class="fa fa-sign-out menu-icon"></i>
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </li>
</ul>
@push('admin_scripts')
    <script></script>
@endpush
