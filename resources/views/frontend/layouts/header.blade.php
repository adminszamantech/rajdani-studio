@php
    $projectCategories = App\Models\ProjectCategory::where(['is_active'=>true])->get();
@endphp
<header>
    <div class="navbar-default border-bottom border-color-light-white" style="background: #641e16">
        <div class="container lg-container">
            <div class="row align-items-center">
                <div class="col-12 col-lg-12">
                    <div class="menu_area alt-font">
                        <nav class="navbar navbar-expand-lg navbar-light no-padding d-flex justify-content-between">
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

                            <div class="social">
                                <a href="https://wa.me/88{{ website()->whatsapp_number ?? '' }}" target="_blank" class="btn btn-success rounded-circle d-inline-flex align-items-center justify-content-center me-2" style="width: 40px; height: 40px;">
                                    <i class="fab fa-whatsapp"></i>
                                  </a>
                                  <a href="{{ website()->linkedin_link ?? '' }}" target="_blank" class="btn btn-info rounded-circle d-inline-flex align-items-center justify-content-center me-2" style="width: 40px; height: 40px;">
                                    <i class="fab fa-linkedin-in"></i>
                                  </a>
                                  <a href="{{ website()->facebook_link ?? '' }}" target="_blank" class="btn btn-primary rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                    <i class="fab fa-facebook-f"></i>
                                  </a>

                            </div>
                        </nav>


                        {{-- <nav class="navbar navbar-expand-lg navbar-light no-padding d-flex justify-content-between" id="mobile_nav">
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

                            <div class="social">
                                <a href="https://wa.me/88{{ website()->whatsapp_number ?? '' }}" target="_blank" class="btn btn-success rounded-circle d-inline-flex align-items-center justify-content-center me-2" style="width: 40px; height: 40px;">
                                    <i class="fab fa-whatsapp"></i>
                                  </a>
                                  <a href="{{ website()->linkedin_link ?? '' }}" target="_blank" class="btn btn-info rounded-circle d-inline-flex align-items-center justify-content-center me-2" style="width: 40px; height: 40px;">
                                    <i class="fab fa-linkedin-in"></i>
                                  </a>
                                  <a href="{{ website()->facebook_link ?? '' }}" target="_blank" class="btn btn-primary rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                    <i class="fab fa-facebook-f"></i>
                                  </a>

                            </div>
                        </nav> --}}

                    </div>
                </div>
            </div>
        </div>
    </div>

</header>
