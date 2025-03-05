@extends('frontend.layouts.main')
@section('title', 'Service Details page')

@section('content')
        <!-- start page title section -->
        <section class="page-title-section bg-img cover-background" data-overlay-dark="75" data-background="{{ asset('/storage/frontend/img/banner/page-title.jpg') }}">
            <div class="container">

                <div class="row">
                    <div class="col-md-12">
                        <h1>Service Details</h1>
                    </div>
                    <div class="col-md-12">
                        <ul>
                            <li><a href="{{ route('home.index') }}">Home</a></li>
                            <li><a href="javascript:void(0)">Service Details</a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </section>
        <!-- end page title section -->

        <!-- start service detail section -->
        <section>
            <div class="container">
                <div class="row">

                    <!--  start blog left-->
                    <div class="col-lg-4 col-md-12 sm-margin-40px-bottom">
                        <div class="service-side-bar padding-40px-right md-padding-10px-right sm-no-padding-right">

                            <div class="widget">
                                <div class="widget-title">
                                    <h6>Other Services</h6>
                                </div>
                                <ul class="no-margin-bottom">
                                    @foreach ($services as $item)
                                        <li>
                                            <i class="ti-layout"></i>
                                            <h5 class="no-margin-bottom font-size16 xs-font-size15 line-height-26 xs-line-height-24 font-weight-500"><a href="javascript:void(0);" class="text-black">{{ $item->title ?? '' }}</a></h5>
                                            <p class="no-margin-bottom">{!! Str::limit(strip_tags($item->description),25) !!}</p>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>
                    </div>
                    <!--  end blog left-->

                    <!--  start blog right-->
                    <div class="col-lg-8 col-md-12">
                        <div class="service-detail-block">
                            <div class="row image">
                                <div class="col-lg-12 padding-5px-lr sm-margin-10px-bottom xs-no-margin-bottom">
                                    <div>
                                        @if ($service->type == 'image')
                                            <img class="w-100" src="{{ asset('/storage/admin/assets/images/service/' . $service->image_video) }}"
                                                alt="image" />
                                        @elseif($service->type == 'video')
                                            <video width="100%" controls>
                                                <source
                                                    src="{{ asset('/storage/admin/assets/images/service/' . $service->image_video) }}"
                                                    type="video/mp4">
                                                browser not support.
                                            </video>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <h4>{{ $service->title ?? '' }}</h4>
                            <div>
                                {!! $service->description !!}
                            </div>
                        </div>
                    </div>
                    <!--  end blog right-->

                </div>
            </div>
        </section>
@endsection
