@extends('frontend.layouts.main')
@section('title', 'Home Page')

@section('content')
    <div class="rev_slider_wrapper fullscreen custom-controls">
        <div id="rev_slider_2" class="rev_slider fullscreenbanner" style="display: none;" data-version="5.4.5">
            <ul>
                @foreach ($sliders as $slider)
                    <li data-transition="fade">

                        <!-- overlay -->
                        <div class="opacity-medium bg-black z-index-1"></div>

                        <img src="{{ asset('/storage/admin/assets/images/slider/' . $slider->image) }}" alt="slide3"
                            class="rev-slidebg">

                        <!-- start layer 1 -->
                        <div class="tp-caption tp-resizeme alt-font font-weight-400 text-white text-uppercase text-right"
                            data-x="['right','right','right','right']" data-y="center" data-voffset="[-150,-140,-130,-100]"
                            data-hoffset="['30','30',30','30']" data-fontsize="[20,20,18,16]"
                            data-lineheight="[20,20,18,18]" data-width="[650, 500, 400, 300]"
                            data-whitespace="[nowrap, nowrap, nowrap, normal]"
                            data-frames='[{
                                "delay":0,
                                "split":"chars",
                                "splitdelay":0.05,
                                "speed":2000,
                                "frame":"0",
                                "from":"y:[-100%];z:0;rZ:35deg;sX:1;sY:1;skX:0;skY:0;",
                                "mask":"x:0px;y:0px;s:inherit;e:inherit;",
                                "to":"o:1;",
                                "ease":"Power4.easeInOut"
                                },{
                                "delay":"wait",
                                "speed":300,
                                "frame":"999",
                                "to":"auto:auto;",
                                "ease":"Power3.easeInOut"}]'
                            data-splitout="none">{{ $slider->description ?? '' }}
                        </div>
                        <!-- end layer 1 -->

                        <!-- start layer 2 -->
                        <div class="tp-caption tp-resizeme slider-text text-white font-weight-700 text-right"
                            data-x="['right','right','right','right']" data-y="center" data-voffset="[-30,-30,-30,-25]"
                            data-hoffset="['30','30',30','30']" data-fontsize="[62,58,52,38]"
                            data-lineheight="[76, 76, 65, 50]" data-width="[750, 700, 600, 550]"
                            data-whitespace="[normal, normal, normal, normal]"
                            data-frames='[{
                                "delay":1400,
                                "speed":1500,
                                "frame":"0",
                                "from":"y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;",
                                "mask":"x:0px;y:0px;s:inherit;e:inherit;","to":"o:1;",
                                "ease":"Power3.easeInOut"
                                },{
                                "delay":"wait",
                                "speed":300,
                                "frame":"999",
                                "to":"auto:auto;",
                                "ease":"Power3.easeInOut"}]'>
                            {!! $slider->title ?? '' !!}
                        </div>
                        <!-- end layer 2 -->

                        <!-- start layer 3 -->
                        <div class="tp-caption tp-resizeme" data-x="['right','right','right','right']" data-y="center"
                            data-voffset="[110,110,95,85]" data-lineheight="55" data-width="[160, 160, 160, 160]"
                            data-hoffset="['30','30',30','30']"
                            data-frames='[{
                                    "delay":1800,
                                "speed":2000,
                                "frame":"0",
                                "from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;",
                                "to":"o:1;",
                                "ease":"Power4.easeInOut"
                                },{
                                "delay":"wait",
                                "speed":300,
                                "frame":"999",
                                "to":"auto:auto;",
                                "ease":"Power3.easeInOut"}]'>
                            <a href='javascript:void(0)'
                                class='butn theme'><span>{{ $slider->button_text ?? '' }}</span></a>
                        </div>
                        <!-- end layer 3 -->

                    </li>
                @endforeach


            </ul>
        </div>
    </div>

    <!-- start about section -->
    <section>
        <div class="container">
            @foreach ($profiles as $profile)
                <div class="row align-items-center">
                    <div class="col-lg-6 sm-margin-30px-bottom">
                        <div class="about-block">
                            <div class="image">
                                @if ($profile->type == 'image')
                                    <img class="w-100"
                                        src="{{ asset('/storage/admin/assets/images/profile/' . $profile->image_video) }}"
                                        alt="image" />
                                @elseif($profile->type == 'video')
                                    <video width="100%" controls>
                                        <source
                                            src="{{ asset('/storage/admin/assets/images/profile/' . $profile->image_video) }}"
                                            type="video/mp4">
                                        browser not support.
                                    </video>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="padding-80px-left md-padding-50px-left sm-no-padding-left">
                            <h3
                                class="font-size15 md-font-size14 sm-font-size13 text-uppercase margin-15px-bottom md-margin-10px-bottom font-weight-400 letter-spacing-3 word-spacing-3 text-theme-color">
                                About Us</h3>
                            <h4
                                class="font-size40 md-font-size36 sm-font-size30 xs-font-size26 font-weight-500 margin-25px-bottom md-margin-25px-bottom sm-margin-15px-bottom">
                                {{ $profile->title ?? '' }}</h4>
                            <div>
                                {!! $profile->description !!}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    <!-- end about section -->

    <!-- start service section -->
    <section>
        <div class="container">
            <div class="margin-50px-bottom xs-margin-30px-bottom text-center">
                <h3
                    class="font-size13 text-uppercase margin-15px-bottom md-margin-10px-bottom font-weight-400 letter-spacing-3 word-spacing-3 text-theme-color">
                    What We Do</h3>
                <h4 class="font-size38 sm-font-size34 xs-font-size28 line-height-45 font-weight-500 no-margin-bottom">Latest
                    Services</h4>
            </div>
            <div class="row">
                @foreach ($services as $service)
                    <div class="col-lg-4 sm-margin-30px-bottom">
                        <div class="service-block h-100">
                            <div class="margin-50px-bottom md-margin-40px-bottom xs-margin-30px-bottom">
                                <img src="{{ asset('/storage/admin/assets/images/service/' . $service->icon_image) }}" alt=""
                                    class="md-width-60px xs-width-50px" />
                            </div>
                            <h5
                                class="font-weight-500 font-size22 md-font-size18 md-margin-15px-bottom xs-margin-10px-bottom">
                                <a href="service-details.html" class="text-black">{{ $service->title ?? '' }}</a>
                            </h5>
                            <p class="text">{!! Str::limit(strip_tags($service->description),100) !!}</p>
                            <a href="{{ route('home.serviceDetails',$service->id) }}"
                                class="text-black font-weight-600 font-size14 md-font-size13">Read More<span
                                    class="ti-arrow-right vertical-align-middle font-size12 margin-10px-left float-right font-weight-600"></span></a>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
    <!-- end service section -->

    <!-- start portfolio section -->
    <section>
        <div class="container">
            <div class="margin-50px-bottom xs-margin-30px-bottom text-center">
                <h3
                    class="font-size13 text-uppercase margin-15px-bottom xs-margin-5px-bottom font-weight-400 letter-spacing-3 word-spacing-3 text-theme-color">
                    featured projects.</h3>
                <h4 class="font-size38 xs-font-size28 line-height-45 font-weight-500 no-margin-bottom">Where happiness
                    lives</h4>
            </div>
            <div class="row">
                <div class="gallery text-center width-100">
                    @foreach ($projects->where(['is_active'=>true])->limit(6)->get() as $project)
                        <div class="col-lg-4 col-md-12 sm-margin-25px-bottom items">
                            <div class="portfolio-block position-relative overflow-hidden margin-25px-bottom">
                                <div class="item-img">
                                    @if ($project->type == 'image')
                                            <img class="w-100" src="{{ asset('/storage/admin/assets/images/project/' . $project->image_video) }}"
                                                alt="image" />
                                        @elseif($project->type == 'video')
                                            <video width="100%" controls>
                                                <source
                                                    src="{{ asset('/storage/admin/assets/images/project/' . $project->image_video) }}"
                                                    type="video/mp4">
                                                browser not support.
                                            </video>
                                        @endif
                                </div>
                                <div class="item-content">
                                    <div class="item-icon margin-10px-bottom">
                                        <a href="{{ route('home.projectDetails',$project->id) }}"><i
                                                class="ti-plus text-white font-size18"></i></a>
                                    </div>
                                    <h5
                                        class="no-margin-bottom xs-margin-5px-bottom font-weight-500 font-size24 md-font-size22 xs-font-size20">
                                        <a href="{{ route('home.projectDetails',$project->id) }}" class="text-white">{{ $project->title ?? '' }}</a>
                                    </h5>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- end portfolio section -->

    <!-- start counter section -->
    <section>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-4 xs-margin-25px-bottom">
                    <div class="counter-block text-center">
                        <h4 class="margin-10px-bottom text-theme-color"><span class="countup">238</span></h4>
                        <div class="separator"></div>
                        <h5
                            class="margin-5px-bottom xs-no-margin-bottom text-uppercase font-weight-500 font-size20 sm-font-size18 xs-font-size16">
                            Customers</h5>
                        <p class="no-margin-bottom">Printing and typesetting industry</p>
                    </div>
                </div>
                <div class="col-md-4 xs-margin-25px-bottom">
                    <div class="counter-block text-center">
                        <h4 class="margin-10px-bottom text-theme-color"><span class="countup">10</span></h4>
                        <div class="separator"></div>
                        <h5
                            class="margin-5px-bottom xs-no-margin-bottom text-uppercase font-weight-500 font-size20 sm-font-size18 xs-font-size16">
                            Years Experience</h5>
                        <p class="no-margin-bottom">Various versions have evolved</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="counter-block text-center">
                        <h4 class="margin-10px-bottom text-theme-color"><span class="countup">{{ $projects->count() }}</span></h4>
                        <div class="separator"></div>
                        <h5
                            class="margin-5px-bottom xs-no-margin-bottom text-uppercase font-weight-500 font-size20 sm-font-size18 xs-font-size16">
                            Projects</h5>
                        <p class="no-margin-bottom">variations of passages of Lorem Ipsum</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end counter section -->

    <!-- start testimonial section-->
    <section>
        <div class="container lg-container">
            <div class="margin-50px-bottom xs-margin-30px-bottom text-center">
                <h3
                    class="font-size13 text-uppercase margin-15px-bottom xs-margin-5px-bottom font-weight-400 letter-spacing-3 word-spacing-3 text-theme-color">
                    testimonials</h3>
                <h4 class="font-size38 xs-font-size28 line-height-45 font-weight-500 no-margin-bottom">What our clients say
                </h4>
            </div>

            <div class="owl-carousel owl-theme client">
                @foreach ($testimonials as $testimonial)
                    <div class="client-block">
                        <div class="icon">
                            <i class="fa fa-quote-right"></i>
                        </div>
                        <div class="client-img">
                            <img src="{{ asset('/storage/admin/assets/images/testimonial/'.$testimonial->image_video) }}" alt="image" />
                        </div>
                        <ul class="rating">
                            <li class="star-rate"><i class="fa fa-star" aria-hidden="true"></i></li>
                            <li class="star-rate"><i class="fa fa-star" aria-hidden="true"></i></li>
                            <li class="star-rate"><i class="fa fa-star" aria-hidden="true"></i></li>
                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                        </ul>
                        <p class="xs-margin-15px-bottom">{!! strip_tags($testimonial->comment) ?? '' !!}</p>
                        <h5
                            class="margin-5px-bottom xs-no-margin-bottom font-size20 md-font-size18 xs-font-size16 font-weight-600 text-theme-color">
                            {{ $testimonial->name ?? '' }}</h5>
                        <div class="font-size16 xs-font-size14">{{ $testimonial->designation ?? '' }}</div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
    <!-- end testimonial section-->


    <!-- start clients section -->
    <div class="section-clients bg-light-gray">
        <div class="container">
            <div class="owl-carousel owl-theme clients" id="clients">
                <div class="item"><img alt="partner-image"
                        src="{{ asset('/storage/frontend/img/partners/client-01.png') }}"></div>
                <div class="item"><img alt="partner-image"
                        src="{{ asset('/storage/frontend/img/partners/client-02.png') }}"></div>
                <div class="item"><img alt="partner-image"
                        src="{{ asset('/storage/frontend/img/partners/client-03.png') }}"></div>
                <div class="item"><img alt="partner-image"
                        src="{{ asset('/storage/frontend/img/partners/client-04.png') }}"></div>
                <div class="item"><img alt="partner-image"
                        src="{{ asset('/storage/frontend/img/partners/client-05.png') }}"></div>
                <div class="item"><img alt="partner-image"
                        src="{{ asset('/storage/frontend/img/partners/client-06.png') }}"></div>
            </div>
        </div>
    </div>
    <!-- end clients section -->
@endsection
