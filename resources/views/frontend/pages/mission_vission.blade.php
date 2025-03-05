@extends('frontend.layouts.main')
@section('title', 'Our Mission & Vission')

@section('content')

    <section class="page-title-section bg-img cover-background" data-overlay-dark="75"
        data-background="{{ asset('/storage/frontend/img/banner/page-title.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Mission & Vission</h1>
                </div>
                <div class="col-md-12">
                    <ul>
                        <li><a href="{{ route('home.index') }}">Home</a></li>
                        <li><a href="javascript:void(0)">Mission & Vission</a></li>
                    </ul>
                </div>
            </div>

        </div>
    </section>
    <section>
        <div class="container">
            @foreach ($missionVission as $mission)
                @if ($mission->mv_type == 'mission')
                    <div class="row align-items-center">
                        <div class="col-lg-6 sm-margin-30px-bottom">
                            <div class="about-block">
                                <div class="image">
                                    @if ($mission->type == 'image')
                                        <img class="w-100"
                                            src="{{ asset('/storage/admin/assets/images/mission_vission/' . $mission->image_video) }}"
                                            alt="image" />
                                    @elseif($mission->type == 'video')
                                        <video width="100%" controls>
                                            <source
                                                src="{{ asset('/storage/admin/assets/images/mission_vission/' . $mission->image_video) }}"
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
                                    Mission</h3>
                                <h4
                                    class="font-size40 md-font-size36 sm-font-size30 xs-font-size26 font-weight-500 margin-25px-bottom md-margin-25px-bottom sm-margin-15px-bottom">
                                    {{ $mission->title ?? '' }}</h4>
                                <div>
                                    {!! $mission->description !!}
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </section>
    <section>
        <div class="container">
            @foreach ($missionVission as $vission)
                @if ($vission->mv_type == 'vission')
                    <div class="row align-items-center">
                        <div class="col-lg-6 order-2 order-lg-1">
                            <div class="padding-40px-right md-padding-30px-right sm-no-padding-right">
                                <h3
                                    class="font-size15 md-font-size14 sm-font-size13 text-uppercase margin-15px-bottom md-margin-10px-bottom font-weight-400 letter-spacing-3 word-spacing-3 text-theme-color">
                                    Vission</h3>
                                <h4
                                    class="font-size40 md-font-size36 sm-font-size30 xs-font-size26 font-weight-500 margin-40px-bottom md-margin-25px-bottom">
                                    {{ $vission->title ?? '' }}</h4>

                                <div>
                                    {!! $vission->description !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 order-1 order-lg-2 sm-margin-30px-bottom">
                            <div class="padding-40px-left md-padding-20px-left sm-no-padding-left text-center">
                                @if ($vission->type == 'image')
                                        <img class="w-100"
                                            src="{{ asset('/storage/admin/assets/images/mission_vission/' . $vission->image_video) }}"
                                            alt="image" />
                                    @elseif($vission->type == 'video')
                                        <video width="100%" controls>
                                            <source
                                                src="{{ asset('/storage/admin/assets/images/mission_vission/' . $vission->image_video) }}"
                                                type="video/mp4">
                                            browser not support.
                                        </video>
                                    @endif
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </section>

@endsection
