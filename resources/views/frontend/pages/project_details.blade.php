@extends('frontend.layouts.main')
@section('title', 'Projects Details page')
@push('frontend-css')
    <style>
        .modal .close {
            background-color: red;
            color: white;
            border: none;
            font-size: 1.5rem;
            padding: 5px 5px;

        }
        .modal .close i {
            color: white;
        }
        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            filter: invert(28%) sepia(100%) saturate(4000%) hue-rotate(-50deg) brightness(100%) contrast(100%) !important;
        }
    </style>
@endpush
@section('content')

    <section>
        <div class="container">
            <div class="project-detail-block">
                <div class="row margin-40px-bottom md-margin-25px-bottom">
                    <div class="col-lg-12 sm-margin-25px-bottom">
                        <div class="">
                            @if ($project->type == 'image')
                                <a href="{{ asset('/storage/admin/assets/images/project/' . $project->image_video) }}">
                                    <img class="w-100" src="{{ asset('/storage/admin/assets/images/project/' . $project->image_video) }}" alt="image" />
                                </a>
                            @elseif($project->type == 'video')
                                <video width="100%" controls>
                                    <source src="{{ asset('/storage/admin/assets/images/project/' . $project->image_video) }}" type="video/mp4">
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

            @if (count($project->project_images) > 0)
                <div class="my-5" >
                    <h5 class="text-center text-danger">Project Gallery</h5>
                    <hr>
                </div>
                <div class="row">

                    @foreach ($project->project_images as $index => $item)
                        <!-- Image Thumbnails -->
                        <div class="col-6 col-sm-6 col-md-4 col-lg-3 shadow p-3 m-0">
                            <img class="w-100" src="{{ asset('/storage/admin/assets/images/project/'.$item->image) }}" alt="Preview Image" style="cursor: pointer;" data-toggle="modal" data-target="#exampleModalCenter{{ $item->id }}">
                        </div>

                        <!-- Modal with Carousel -->
                        <div class="modal fade" id="exampleModalCenter{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter{{ $item->id }}Title" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <!-- Carousel -->
                                    <div id="carouselExampleControls{{ $item->id }}" class="carousel slide" data-ride="carousel" style="position: relative">
                                        <div class="carousel-inner">
                                            @foreach ($project->project_images as $carouselIndex => $carouselItem)
                                                <div class="carousel-item {{ $carouselIndex === $index ? 'active' : '' }}">
                                                    <a href="{{ asset('/storage/admin/assets/images/project/'.$carouselItem->image) }}">
                                                        <img class="d-block w-100" src="{{ asset('/storage/admin/assets/images/project/'.$carouselItem->image) }}" alt="Image {{ $carouselIndex + 1 }}">
                                                    </a>
                                                </div>
                                            @endforeach
                                        </div>
                                        <a class="carousel-control-prev" href="#carouselExampleControls{{ $item->id }}" role="button" data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#carouselExampleControls{{ $item->id }}" role="button" data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute;top:-30px;right:0px;">
                                        <i class="fas fa-times-circle"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </section>
@endsection
