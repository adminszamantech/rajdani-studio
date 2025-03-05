@php
    $serviceCategories = App\Models\ServiceCategory::where(['is_active'=>true])->get();
    $projectCategories = App\Models\ProjectCategory::where(['is_active'=>true])->get();
@endphp
<header>

    <div id="top-bar" class="top-bar">
        <div class="container lg-container">
            <div class="row">
                <div class="col-md-3 xs-display-none">
                    <ul class="top-social-icon">
                        <li><a target="_blank" href="{{ website()->twitter_link ?? '' }}"><i class="fab fa-twitter"></i></a></li>
                        <li><a target="_blank" href="{{ website()->linkedin_link ?? '' }}"><i class="fab fa-linkedin-in"></i></a></li>
                        <li><a target="_blank" href="{{ website()->facebook_link ?? '' }}"><i class="fab fa-facebook-f"></i></a></li>
                    </ul>
                </div>
                <div class="col-xs-12 col-md-9">
                    <div class="top-bar-info">
                        <ul>
                            <li><i class="fas fa-phone"></i><a class="text-white" href="tel:+88{{ website()->phone ?? '' }}">{{ '+88'.website()->phone ?? '' }}</a></li>
                            <li><i class="fas fa-envelope"></i><a class="text-white" href="mailto:{{ website()->email ?? '' }}">{{ website()->email ?? '' }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="navbar-default border-bottom border-color-light-white">
        <div class="container lg-container">
            <div class="row align-items-center">
                <div class="col-12 col-lg-12">
                    <div class="menu_area alt-font">
                        <nav class="navbar navbar-expand-lg navbar-light no-padding ">
                            <div class="navbar-header">
                                <a href="{{ route('home.index') }}" class="navbar-brand">
                                    <img id="logo" src="{{ asset('/storage/admin/assets/images/logo/'.website()->logo_image) }}" alt="logo">
                                </a>
                            </div>
                            <div class="navbar-toggler"></div>
                            <ul class="navbar-nav ml-auto" id="nav" style="display: none;">
                                <li><a href="{{ route('home.index') }}">Home</a></li>
                                <li><a href="#">Services</a>
                                    <ul>
                                        @foreach ($serviceCategories as $serviceCategory)
                                            <li><a href="{{ route('home.service',$serviceCategory->id) }}">{{ $serviceCategory->name ?? "" }}</a></li>
                                        @endforeach

                                    </ul>
                                </li>
                                <li><a href="#">Projects</a>
                                    <ul>
                                        @foreach ($projectCategories as $projectCategory)
                                            <li><a href="{{ route('home.project',$projectCategory->id) }}">{{ $projectCategory->name ?? '' }}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li><a href="{{ route('home.gallery') }}">Gallery</a></li>
                                <li><a href="#">About Us</a>
                                    <ul>
                                        <li><a href="{{ route('home.profile') }}">Profile</a></li>
                                        <li><a href="{{ route('home.missionVission') }}">Mission & Vission</a></li>
                                        <li><a href="{{ route('home.message') }}">Message From MD</a></li>
                                    </ul>
                                </li>
                                <li><a href="{{ route('home.contact') }}">Contact Us</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

</header>
