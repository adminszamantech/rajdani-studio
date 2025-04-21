@extends('frontend.layouts.main')
@section('title', 'About Us')
@push('frontend-css')
<style>
    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        filter: invert(28%) sepia(100%) saturate(4000%) hue-rotate(-50deg) brightness(100%) contrast(100%) !important;
    }



    @media screen and (min-width: 320px) and (max-width: 359px) {
        .message-image {
            height: 250px !important;
        }
    }
    @media screen and (min-width: 360px) and (max-width: 399px) {
        .message-image {
            height: 260px !important;
        }
    }
    @media screen and (min-width: 400px) and (max-width: 429px) {
        .message-image{
            height: 325px !important;
        }
    }
    @media screen and (min-width: 430px) and (max-width: 479px) {
        .message-image{
            height: 345px !important;
        }
    }
    @media screen and (min-width: 480px) and (max-width: 511px) {
        .message-image{
            height: 355px !important;
        }
    }

    @media screen and (min-width: 512px) and (max-width: 575px) {
        .message-image{
            height: 385px !important;
        }
    }

    @media screen and (min-width: 576px) and (max-width: 767px) {
        .message-image{
            height: 430px !important;
        }
    }
    @media screen and (min-width: 768px) and (max-width: 991px) {
        .message-image{
            width: 75% !important;
            margin: 0 auto;
            display: block;
            height: 460px !important;
        }
    }
    @media screen and (min-width: 992px) and (max-width: 1199px) {
        .message-image{
            width: 65% !important;
            margin: 0 auto;
            display: block;
            height: 500px !important;
        }
    }

    @media screen and (min-width: 1200px) and (max-width: 1399px) {
        .message-image{
            width: 50% !important;
            margin: 0 auto;
            display: block;
            height: 500px !important;
        }
    }

    @media screen and (min-width: 1400px){
        .message-image{
            width: 50% !important;
            margin: 0 auto;
            display: block;
            height: 500px !important;
        }
    }
</style>
@endpush
@section('content')

    <!-- start about section -->
    <section>
        <div class="container">
            <h6 class="my-3 text-uppercase text-center text-danger">
                About Us
                <hr class="mx-auto bg-danger" style="width: 25%; ">
            </h6>

            @foreach ($profiles as $profile)
                <div class="row d-flex justify-content-center">
                    <div class="col-md-12">
                        <div class="image">
                            @if ($profile->type == 'image')
                                <a href="{{ asset('/storage/admin/assets/images/profile/' . $profile->image_video) }}">
                                    <img class="profile-image img-thumbnail"
                                    style="width: 100%;height:100%;object-fit:fill;"
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
                        <div class="my-5">
                            <h4 class="text-center">{{ $profile->title ?? '' }}</h4>
                            <div class="text-justify">
                                {!! $profile->description !!}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- start message section --}}
        <div class="container">
            <h6 class="my-3 text-uppercase text-center text-danger">
                Message
                <hr class="mx-auto bg-danger" style="width: 25%;">
            </h6>

            @foreach ($messages as $message)
                <div class="row d-flex justify-content-center">
                    <div class="col-md-12">
                        <div class="image">
                            @if ($message->type == 'image')
                                <a href="{{ asset('/storage/admin/assets/images/message/' . $message->image_video) }}">
                                    <img class="message-image img-thumbnail"
                                    style="width: 100%;height:100%;object-fit:fill;"
                                    src="{{ asset('/storage/admin/assets/images/message/' . $message->image_video) }}"
                                    alt="image" />
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
                        <div class="my-5">
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
    </section>
    <!-- end about section -->

@endsection
