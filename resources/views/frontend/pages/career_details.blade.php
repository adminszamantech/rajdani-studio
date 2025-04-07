@extends('frontend.layouts.main')
@section('title', 'Job Details')

@section('content')

    <section class="page-title-section bg-img cover-background" data-overlay-dark="75"
        data-background="{{ asset('/storage/frontend/img/banner/page-title.jpg') }}">
        <div class="container">

            <div class="row">
                <div class="col-md-12">
                    <h1>Job Details</h1>
                </div>
                <div class="col-md-12">
                    <ul>
                        <li><a href="{{ route('home.index') }}">Home</a></li>
                        <li><a href="javascript:void(0)">Job Details</a></li>
                    </ul>
                </div>
            </div>

        </div>
    </section>

    <section>
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-10">
                    @if (session('message'))
                        <div class="alert alert-success my-5">
                            {{ session('message') }}
                        </div>
                    @endif
                    <h3 class="text-danger text-center">{{ $jobPost->title . ' Job Post' ?? '' }}</h3>
                    <hr class="bg-danger">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="float-right">
                                <p class="text-danger"><b>Deadline:
                                        {{ Carbon\Carbon::parse($jobPost->deadline)->format('Y-m-d h:i A') ?? '' }}</b></p>
                            </div>
                            <p>{!! $jobPost->description ?? '' !!}</p>
                        </div>
                        <div class="card-footer ">
                            <button type="button" class="btn btn-sm btn-info float-right" data-toggle="modal"
                                data-target="#applyJobModalCenter">
                                Apply Now
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Apply Job Modal -->
    <div class="modal fade" id="applyJobModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="applyJobModalCenterCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLongTitle">{{ $jobPost->title . ' Apply' ?? '' }}</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('home.jobApply') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="">
                                    <input type="hidden" name="job_post_id" value="{{ $jobPost->id }}">
                                    <div class="form-group">
                                        <label for="exampleInputName1">Full Name</label>
                                        <input type="text" name="full_name" class="form-control"
                                            id="exampleInputName1" placeholder="Full Name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputName1">Email</label>
                                        <input type="email" name="email" class="form-control"
                                            id="exampleInputName1" placeholder="Email" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputName1">Phone</label>
                                        <input type="tel" name="phone" class="form-control" id="exampleInputName1" placeholder="Phone" required pattern="^\d{11}$" title="Phone number must be exactly 11 digits">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputName1">Resume / CV</label>
                                        <input type="file" name="cv" class="form-control"
                                            id="exampleInputName1" placeholder="Resume / CV" required accept=".pdf, application/pdf">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Apply</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
