@extends('frontend.layouts.main')
@section('title', 'Our Achievement Photos')

@section('content')
<section class="page-title-section bg-img cover-background" data-overlay-dark="75" data-background="{{ asset('/storage/frontend/img/banner/page-title.jpg') }}">
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <h1>Our Gallery</h1>
            </div>
            <div class="col-md-12">
                <ul>
                    <li><a href="{{ route('home.index') }}">Home</a></li>
                    <li><a href="javascript:void(0)">Gallery</a></li>
                </ul>
            </div>
        </div>

    </div>
</section>
<!-- end page title section -->

<!-- start certification section -->
<section>
    <div class="container">
        <div class="margin-50px-bottom xs-margin-40px-bottom text-center">
            <h3 class="font-size13 text-uppercase margin-15px-bottom xs-margin-5px-bottom font-weight-400 letter-spacing-3 word-spacing-3 text-theme-color">DO YOU KNOWS US?</h3>
            <h4 class="font-size38 sm-font-size32 xs-font-size28 line-height-45 sm-line-height-40 font-weight-500 no-margin-bottom width-70 xs-width-auto center-col">Our Achievement  Photos</h4>
        </div>
        <div class="row">
            <div class="col-lg-10 center-col">
                <div class="row">
                    <div class="gallery text-center width-100">
                        @foreach ($galleries as $gallery)
                            <div class="col-lg-4 margin-30px-bottom items">
                                @if ($gallery->type == 'image')
                                        <a href="{{ asset('/storage/admin/assets/images/gallery/' . $gallery->image_video) }}" target="_blank">
                                            <img class="w-100"
                                            src="{{ asset('/storage/admin/assets/images/gallery/' . $gallery->image_video) }}"
                                            alt="image" />
                                        </a>
                                    @elseif($gallery->type == 'video')
                                        <a href="{{ asset('/storage/admin/assets/images/gallery/' . $gallery->image_video) }}" target="_blank">
                                            <video width="100%" controls>
                                                <source
                                                    src="{{ asset('/storage/admin/assets/images/gallery/' . $gallery->image_video) }}"
                                                    type="video/mp4">
                                                browser not support.
                                            </video>
                                        </a>
                                    @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
