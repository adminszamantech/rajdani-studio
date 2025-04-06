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
                            data-x="['right','right','right','right']" data-y="center" data-voffset="[110,110,95,85]"
                            data-hoffset="['30','30',30','30']" data-fontsize="[25,25,22,20]"
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
                            data-splitout="none">{{ $slider->title ?? '' }}
                        </div>
                        <div class="tp-caption tp-resizeme alt-font font-weight-400 text-white text-uppercase text-right"
                            data-x="['right','right','right','right']" data-y="center" data-voffset="[150, 150, 150, 150]"
                            data-hoffset="['30','30',30','30']" data-fontsize="[20,20,18,16]"
                            data-lineheight="[20,20,18,18]" data-width="[650, 500, 400, 300]"
                            data-whitespace="[nowrap, nowrap, nowrap, normal]"
                            data-frames='[{
                                "delay":1400,
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
                                class="font-size15 md-font-size14 sm-font-size13 text-uppercase margin-15px-bottom md-margin-10px-bottom font-weight-900 letter-spacing-3 word-spacing-3 text-theme-color">
                                About Us</h3>
                            <h4
                                class="font-size40 md-font-size36 sm-font-size30 xs-font-size26 font-weight-500 margin-25px-bottom md-margin-25px-bottom sm-margin-15px-bottom">
                                {{ $profile->title ?? '' }}</h4>
                            <div>
                                {!! \Illuminate\Support\Str::limit(strip_tags($profile->description), 300) !!}
                            </div>
                            <div class="my-3">
                                <a href="{{ route('home.profile') }}" class="btn btn-md btn-outline-danger" >Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    <!-- end about section -->

    {{-- start message section --}}
    <div class="container">
        @foreach ($messages as $message)
            <div class="row align-items-center">
                <div class="col-lg-6 sm-margin-30px-bottom">
                    <div class=" ">
                        <h3
                            class="font-size15 md-font-size14 sm-font-size13 text-uppercase margin-15px-bottom md-margin-10px-bottom font-weight-900 letter-spacing-3 word-spacing-3 text-theme-color">
                            Message</h3>
                        <h4
                            class="font-size40 md-font-size36 sm-font-size30 xs-font-size26 font-weight-500 margin-25px-bottom md-margin-25px-bottom sm-margin-15px-bottom">
                            {{ $message->title ?? '' }}</h4>
                        <div>
                            {!! $message->description !!}
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-block" style="padding-left: 75px;">
                        <div class="image">
                            @if ($message->type == 'image')
                                <img class="w-100"
                                    src="{{ asset('/storage/admin/assets/images/message/' . $message->image_video) }}"
                                    alt="image" />
                            @elseif($message->type == 'video')
                                <video width="100%" controls>
                                    <source
                                        src="{{ asset('/storage/admin/assets/images/message/' . $message->image_video) }}"
                                        type="video/mp4">
                                    browser not support.
                                </video>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {{-- end message section --}}

    <!-- start testimonial section-->
    <section>
        <div class="container lg-container">
            <div class="margin-50px-bottom xs-margin-30px-bottom text-center">
                <h3
                    class="font-size13 text-uppercase margin-15px-bottom xs-margin-5px-bottom font-weight-900 letter-spacing-3 word-spacing-3 text-theme-color">
                    Category Wise Latest Projects</h3>
                </h4>
            </div>
            <nav class="d-flex justify-content-center">
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    @foreach ($projectCats as $index => $projectCat)
                        <a class="nav-item nav-link {{ request()->get('tab') == $projectCat->id || (request()->get('tab') === null && $index === 0) ? 'active' : '' }}"
                           id="nav-projectCat-{{ $projectCat->id }}-tab"
                           data-toggle="tab"
                           href="#nav-projectCat-{{ $projectCat->id }}"
                           role="tab"
                           aria-controls="nav-projectCat-{{ $projectCat->id }}"
                           aria-selected="{{ request()->get('tab') == $projectCat->id || (request()->get('tab') === null && $index === 0) ? 'true' : 'false' }}">
                            {{ $projectCat->name }}
                        </a>
                    @endforeach
                </div>
            </nav>

            <div class="tab-content" id="nav-tabContent">
                @foreach ($projectCats as $index => $projectCat)
                    <div class="tab-pane fade {{ request()->get('tab') == $projectCat->id || (request()->get('tab') === null && $index === 0) ? 'show active' : '' }}" id="nav-projectCat-{{ $projectCat->id }}" role="tabpanel" aria-labelledby="nav-projectCat-{{ $projectCat->id }}-tab">

                            <div class="row mt-5">
                                @foreach (cat_wise_projects($projectCat->id) as $project)
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
