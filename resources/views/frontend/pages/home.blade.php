@extends('frontend.layouts.main')
@section('title', 'Home Page')
@push('frontend-css')
<style>
    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        filter: invert(28%) sepia(100%) saturate(4000%) hue-rotate(-50deg) brightness(100%) contrast(100%) !important;
    }
    /* .slider-img {
        width: 100%;
        object-fit: fill;
    }
    .profile-image {
        width: 100%;
        height: 100%;
        object-fit: fill;
    } */

    @media screen and (min-width: 320px) and (max-width: 359px) {
        .message-image{
            height: 250px !important;
        }
    }
    @media screen and (min-width: 360px) and (max-width: 399px) {
        .message-image{
            height: 280px !important;
        }
    }
    @media screen and (min-width: 400px) and (max-width: 429px) {
        .message-image{
            height: 300px !important;
        }
    }

    @media screen and (min-width: 430px) and (max-width: 479px) {
        .message-image{
            height: 320px !important;
        }
    }
    @media screen and (min-width: 480px) and (max-width: 511px) {
        .message-image{
            height: 380px !important;
        }
    }

    @media screen and (min-width: 512px) and (max-width: 575px) {
        .message-image{
            height: 400px !important;
        }
    }

    @media screen and (min-width: 576px) and (max-width: 767px) {
        .message-image{
            height: 380px !important;
        }
    }
    @media screen and (min-width: 768px) and (max-width: 991px) {
        .message-image{
            height: 340px !important;
        }
    }
    @media screen and (min-width: 992px) and (max-width: 1199px) {
        .message-image{
            height: 400px !important;
        }
    }

    @media screen and (min-width: 1200px) and (max-width: 1399px) {
        .message-image{
            height: 460px !important;
        }
    }

    @media screen and (min-width: 1400px){
        .message-image{
            height: 815px !important;
        }
    }


    @media (max-width: 414px) {
        .text-xs-mobile {
            font-size: 0.7rem !important;
            padding:0px 5px;
            margin:0px;
        }
    }
</style>
@endpush
@section('content')
    {{-- start slider section --}}
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            @foreach ($sliders as $index => $slider)
                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                    <a href="{{ asset('/storage/admin/assets/images/slider/' . $slider->image) }}">
                        <img class="d-block w-100 slider-img"  src="{{ asset('/storage/admin/assets/images/slider/' . $slider->image) }}" alt="Slide {{ $index + 1 }}">
                    </a>
                </div>
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    {{-- end slider section --}}


    <!-- start about section -->
    <section>
        <div class="container">
            <h6 class="my-3 text-uppercase text-center text-danger">
                About Us
                <hr class="mx-auto bg-danger" style="width: 25%; ">
            </h6>

            @foreach ($profiles as $profile)
            <div class="row align-items-center">
                <div class="col-md-6 pt-4">
                    <div class="image">
                        @if ($profile->type == 'image')
                            <a href="{{ asset('/storage/admin/assets/images/profile/' . $profile->image_video) }}">
                                <img class="profile-image img-thumbnail"
                                src="{{ asset('/storage/admin/assets/images/profile/' . $profile->image_video) }}"
                                alt="image" />
                            </a>
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
                <div class="col-md-6 pt-4">
                    <div class="">
                        <h4 class="">{{ $profile->title ?? '' }}</h4>
                        <div class="text-justify">
                            {!! \Illuminate\Support\Str::limit($profile->description, 500) !!}
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
        <h6 class="my-3 text-uppercase text-center text-danger">
           Message
            <hr class="mx-auto bg-danger" style="width: 25%; ">
        </h6>


        @foreach ($messages as $message)

            <div class="row">
                <div class="col-md-12">
                    <div class="row d-flex justify-content-center pt-4">
                        <div class="col-6 col-sm-6 col-md-4 col-lg-3 image">
                            @if ($message->type == 'image')
                                <a href="{{ asset('/storage/admin/assets/images/message/' . $message->image_video) }}">
                                    <img src="{{ asset('/storage/admin/assets/images/message/' . $message->image_video) }}" class="img-fluid rounded-circle" alt="Profile Image">
                                </a>
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

                <div class="col-md-12 pt-5">
                    <div class="">
                        <h4 class="text-center">{{ $message->title ?? '' }}</h4>
                        <div class="text-justify">
                            {!! $message->description !!}
                        </div>
                    </div>
                </div>

            </div>
        @endforeach
    </div>
    {{-- end message section --}}


    <!-- start projects section-->
    <section>
        <div class="container lg-container">
            <div class="margin-50px-bottom xs-margin-30px-bottom text-center">
                <h6 class="my-3 text-uppercase text-center text-danger">
                    Category Wise Latest Projects
                     <hr class="mx-auto bg-danger" style="width: 25%; ">
                 </h6>

            </div>
            <nav class="d-flex justify-content-center">
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    @foreach ($projectCats as $index => $projectCat)
                        <a class="nav-item nav-link text-xs-mobile fs-md-5  {{ request()->get('tab') == $projectCat->id || (request()->get('tab') === null && $index === 0) ? 'active' : '' }}"
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
                                <div class="col-6 col-sm-6 col-md-6 col-lg-4 sm-margin-25px-bottom items">
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
    <!-- end projects section-->

    <!-- start testimonial section-->
    <section>
        <div class="container lg-container">
            <div class="margin-50px-bottom xs-margin-30px-bottom text-center">

                <h6 class="my-3 text-uppercase text-center text-danger">
                    Testimonials</h6>
                <p class="text-danger">What our clients say</p>
                <hr class="mx-auto bg-danger" style="width: 25%; ">
            </div>

            <div class="owl-carousel owl-theme client">
                @foreach ($testimonials as $testimonial)
                        @if($testimonial->type == 'video')
                            <div class="client-block">

                                <video style="width=100%;height:125px" controls>
                                    <source
                                        src="{{ asset('/storage/admin/assets/images/testimonial/' . $testimonial->image_video) }}"
                                        type="video/mp4">
                                    browser not support.
                                </video>
                                <p class="xs-margin-15px-bottom">{!! strip_tags($testimonial->comment) ?? '' !!}</p>
                                <h5
                                    class="margin-5px-bottom xs-no-margin-bottom font-size20 md-font-size18 xs-font-size16 font-weight-600 text-theme-color">
                                    {{ $testimonial->name ?? '' }}</h5>
                                <div class="font-size16 xs-font-size14">{{ $testimonial->designation ?? '' }}</div>
                            </div>
                        @else
                            <div class="client-block">
                                <div class="icon">
                                    <i class="fa fa-quote-right"></i>
                                </div>
                                <div class="client-img">
                                    <a href="{{ asset('/storage/admin/assets/images/testimonial/'.$testimonial->image_video) }}">
                                        <img src="{{ asset('/storage/admin/assets/images/testimonial/'.$testimonial->image_video) }}" alt="image" />
                                    </a>
                                </div>

                                <ul class="rating">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $testimonial->review)
                                            <li class="star-rate"><i class="fa fa-star" aria-hidden="true"></i></li>
                                        @else
                                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                        @endif
                                    @endfor
                                </ul>
                                <p class="xs-margin-15px-bottom">{!! strip_tags($testimonial->comment) ?? '' !!}</p>
                                <h5
                                    class="margin-5px-bottom xs-no-margin-bottom font-size20 md-font-size18 xs-font-size16 font-weight-600 text-theme-color">
                                    {{ $testimonial->name ?? '' }}</h5>
                                <div class="font-size16 xs-font-size14">{{ $testimonial->designation ?? '' }}</div>
                            </div>
                        @endif


                @endforeach

            </div>
        </div>
    </section>
    <!-- end testimonial section-->

    <!-- start clients section -->
    <div class="section-clients bg-light-gray">
        <div class="container">
            <div class="owl-carousel owl-theme " id="clients"> <!-- class add clients for image light  -->
                @foreach ($clients as $client)
                    <div class="item">
                        <a href="{{ asset('/storage/frontend/img/client/'.$client->image) }}">
                            <img alt="partner-image" src="{{ asset('/storage/frontend/img/client/'.$client->image) }}">
                        </a>

                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- end clients section -->
@endsection
