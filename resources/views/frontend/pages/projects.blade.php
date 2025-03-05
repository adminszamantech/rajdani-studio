@extends('frontend.layouts.main')
@section('title', 'Projects Page')

@section('content')

<section class="page-title-section bg-img cover-background" data-overlay-dark="75" data-background="{{ asset('/storage/frontend/img/banner/page-title.jpg') }}">
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <h1>Our Projects</h1>
            </div>
            <div class="col-md-12">
                <ul>
                    <li><a href="{{ route('home.index') }}">Home</a></li>
                    <li><a href="javascript:void(0)">Projects</a></li>
                </ul>
            </div>
        </div>

    </div>
</section>
<!-- end page title section -->

<!-- start service section -->
<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 margin-30px-bottom xs-margin-25px-bottom text-center">
                <h2>{{ $projectCategory->name ?? '' }}</h2>
            </div>
            @foreach ($projects as $project)
                <div class="col-lg-4 col-md-6 margin-30px-bottom xs-margin-25px-bottom">
                    <div class="service-block02">
                        <div>
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
                        <div class="padding-25px-all md-padding-20px-all">
                            <h5 class="font-weight-500 font-size22 md-font-size18 md-margin-10px-bottom xs-margin-10px-bottom"><a href="{{ route('home.projectDetails',$project->id) }}" class="text-black">{{ $project->title ?? '' }}</a></h5>
                            <p class="text">{!! Str::limit(strip_tags($project->description),100) !!}</p>
                            <a href="{{ route('home.projectDetails',$project->id) }}" class="text-black font-weight-600 font-size14 md-font-size13">Read More<span class="ti-arrow-right vertical-align-middle font-size12 margin-10px-left float-right font-weight-600"></span></a>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</section>
@endsection
