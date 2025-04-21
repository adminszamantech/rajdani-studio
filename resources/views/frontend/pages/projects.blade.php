@extends('frontend.layouts.main')
@section('title', 'Projects Page')
@section('frontend-css')
    <style>
        .pagination-outer{ text-align: center; }
        .pagination{
            font-family: 'Raleway', sans-serif;
            display: inline-flex;
            position: relative;
        }
        .pagination li a.page-link{
            color: #641e16;
            background: #eee;
            font-size: 17px;
            font-weight: 700;
            text-align: center;
            line-height: 33px;
            height: 35px;
            width: 35px;
            padding: 0;
            margin: 0 7px;
            border: none;
            border-radius: 0;
            display: block;
            position: relative;
            z-index: 0;
            transition: all 0.1s ease 0s;
        }
        .pagination li:first-child a.page-link,
        .pagination li:last-child a.page-link{
            font-size: 23px;
            line-height: 30px;
        }
        .pagination li a.page-link:hover,
        .pagination li a.page-link:focus,
        .pagination li.active a.page-link:hover,
        .pagination li.active a.page-link{
            color: #fff;
            background: transparent;
        }
        .pagination li a.page-link:before,
        .pagination li a.page-link:after{
            content: '';
            background-color: #641e16;
            height: 60%;
            width: 100%;
            opacity: 0;
            position: absolute;
            left: 0;
            top: 0;
            z-index: -1;
            transition: all 0.3s ease 0s;
            clip-path: polygon(50% 0%, 100% 50%, 50% 100%, 0% 50%);
        }
        .pagination li a.page-link:after{
            top: auto;
            bottom: 0;
        }
        .pagination li a.page-link:hover:before,
        .pagination li a.page-link:focus:before,
        .pagination li.active a.page-link:hover:before,
        .pagination li.active a.page-link:before{
            opacity: 1;
            top: 3px;
        }
        .pagination li a.page-link:hover:after,
        .pagination li a.page-link:focus:after,
        .pagination li.active a.page-link:hover:after,
        .pagination li.active a.page-link:after{
            opacity: 1;
            bottom: 3px;
        }
        .page-item.active .page-link {
            background-color: #641e16 !important;
            border: none !important;
        }
    </style>
@section('content')

<!-- start service section -->
<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 margin-30px-bottom xs-margin-25px-bottom text-center">
                <h6 class="my-3 text-uppercase text-center text-danger">
                    {{ $projectCategory->name ?? '' }}
                    <hr class="mx-auto bg-danger" style="width: 25%;">
                </h6>
            </div>
            @foreach ($projects as $project)
                <div class="col-12 col-sm-6 col-md-6 col-lg-4 margin-30px-bottom xs-margin-25px-bottom">
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
        {{-- Pagination --}}

        @if ($projects->total() > $projects->perPage())
            <div class="row">
                <div class="col-12 d-flex justify-content-center mt-4">
                    <div class="demo">
                        <nav class="pagination-outer" aria-label="Page navigation">
                            <ul class="pagination">
                                @if ($projects->onFirstPage())
                                    <li class="page-item disabled">
                                        <span class="page-link" aria-hidden="true">«</span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $projects->previousPageUrl() }}" aria-label="Previous">
                                            <span aria-hidden="true">«</span>
                                        </a>
                                    </li>
                                @endif
                                @foreach ($projects->getUrlRange(1, $projects->lastPage()) as $page => $url)
                                    <li class="page-item {{ $projects->currentPage() == $page ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endforeach
                                @if ($projects->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $projects->nextPageUrl() }}" aria-label="Next">
                                            <span aria-hidden="true">»</span>
                                        </a>
                                    </li>
                                @else
                                    <li class="page-item disabled">
                                        <span class="page-link" aria-hidden="true">»</span>
                                    </li>
                                @endif
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        @endif

    </div>
</section>
@endsection
