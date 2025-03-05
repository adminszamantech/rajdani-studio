@extends('frontend.layouts.main')
@section('title', 'Projects Details page')

@section('content')
    <section class="page-title-section bg-img cover-background" data-overlay-dark="75" data-background="{{ asset('/storage/frontend/img/banner/page-title.jpg') }}">
        <div class="container">

            <div class="row">
                <div class="col-md-12">
                    <h1>Project Details</h1>
                </div>
                <div class="col-md-12">
                    <ul>
                        <li><a href="{{ route('home.index') }}">Home</a></li>
                        <li><a href="javascript:void(0)">Project Details</a></li>
                    </ul>
                </div>
            </div>

        </div>
    </section>
    <section>
        <div class="container">
            <div class="project-detail-block">
                <div class="row margin-40px-bottom md-margin-25px-bottom">
                    <div class="col-lg-12 sm-margin-25px-bottom">
                        <div class="">
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
                    </div>
                </div>

                <h4>{{ $project->title ?? '' }}</h4>
                <div>
                    {!! $project->description !!}
                </div>
            </div>
        </div>
    </section>
@endsection
