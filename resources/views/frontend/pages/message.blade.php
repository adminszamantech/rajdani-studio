@extends('frontend.layouts.main')
@section('title', 'Message From MD')

@section('content')

    <section class="page-title-section bg-img cover-background" data-overlay-dark="75"
        data-background="{{ asset('/storage/frontend/img/banner/page-title.jpg') }}">
        <div class="container">

            <div class="row">
                <div class="col-md-12">
                    <h1>Message From MD</h1>
                </div>
                <div class="col-md-12">
                    <ul>
                        <li><a href="{{ route('home.index') }}">Home</a></li>
                        <li><a href="javascript:void(0)">Message From MD</a></li>
                    </ul>
                </div>
            </div>

        </div>
    </section>

    <section>
        <div class="container">
            @foreach ($messages as $message)
                <div class="row align-items-center">
                    <div class="col-lg-6 sm-margin-30px-bottom">
                        <div class="about-block">
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
                    <div class="col-lg-6">
                        <div class="padding-80px-left md-padding-50px-left sm-no-padding-left">
                            <h3
                                class="font-size15 md-font-size14 sm-font-size13 text-uppercase margin-15px-bottom md-margin-10px-bottom font-weight-400 letter-spacing-3 word-spacing-3 text-theme-color">
                                Message</h3>
                            <h4
                                class="font-size40 md-font-size36 sm-font-size30 xs-font-size26 font-weight-500 margin-25px-bottom md-margin-25px-bottom sm-margin-15px-bottom">
                                {{ $message->title ?? '' }}</h4>
                            <div>
                                {!! $message->description !!}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

@endsection
