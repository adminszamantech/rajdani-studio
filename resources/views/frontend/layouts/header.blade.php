@php
    $projectCategories = App\Models\ProjectCategory::where(['is_active'=>true])->get();
@endphp
<header>
    <div class="navbar-default border-bottom border-color-light-white" style="background: #B20915;">
        <div class="container lg-container">
            <div class="row align-items-center">
                <div class="col-12 col-lg-12">
                    <div class="menu_area alt-font">
                        <nav class="navbar navbar-expand-lg navbar-light no-padding d-flex justify-content-between" id="mobile_nav">
                            <div class="navbar-header">
                                <a href="{{ route('home.index') }}" class="navbar-brand">
                                    <img id="logo" src="{{ asset('/storage/admin/assets/images/logo/'.website()->logo_image) }}" alt="logo">
                                </a>
                            </div>
                            <div class="navbar-toggler"></div>
                            <ul class="navbar-nav" id="nav" style="display: none;">
                                <li><a class="text-white" href="{{ route('home.index') }}">Home</a></li>
                                <li><a class="text-white" href="{{ route('home.profile') }}">About Us</a></li>
                                <li><a class="text-white" href="#">Projects</a>
                                    <ul>
                                        @foreach ($projectCategories as $projectCategory)
                                            <li><a href="{{ route('home.project',$projectCategory->id) }}">{{ $projectCategory->name ?? '' }}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li><a class="text-white" href="{{ route('home.career') }}">Career</a></li>
                                <li><a class="text-white" href="{{ route('home.contact') }}">Contact Us</a></li>
                            </ul>
                            <div>
                                <ul class="top-social-icon">
                                    <li><a target="_blank" class="btn btn-success btn-sm rounded-circle text-white d-flex align-items-center justify-content-center" style="width: 32px;height:32px" href="https://wa.me/88{{ website()->whatsapp_number ?? '' }}"><i class="fab fa-whatsapp"></i></a></li>
                                    <li><a target="_blank" class="btn btn-info btn-sm rounded-circle text-white d-flex align-items-center justify-content-center" style="width: 32px;height:32px" href="{{ website()->linkedin_link ?? '' }}"><i class="fab fa-linkedin-in"></i></a></li>
                                    <li><a target="_blank" class="btn btn-primary btn-sm rounded-circle text-white d-flex align-items-center justify-content-center" style="width: 32px;height:32px" href="{{ website()->facebook_link ?? '' }}"><i class="fab fa-facebook-f"></i></a></li>
                                </ul>
                            </div>
                        </nav>

                    </div>
                </div>
            </div>
        </div>
    </div>

</header>
