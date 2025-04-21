@extends('frontend.layouts.main')
@section('title', 'Career')

@section('content')
{{--
    <section class="page-title-section bg-img cover-background" data-overlay-dark="75" data-background="{{ asset('/storage/frontend/img/banner/page-title.jpg') }}">
        <div class="container">

            <div class="row">
                <div class="col-md-12">
                    <h1>Career</h1>
                </div>
                <div class="col-md-12">
                    <ul>
                        <li><a href="{{ route('home.index') }}">Home</a></li>
                        <li><a href="javascript:void(0)">Career</a></li>
                    </ul>
                </div>
            </div>

        </div>
    </section> --}}

    <section>
        <div class="container my-5">
            <div class="row d-flex justify-content-center">
               <div class="col-md-6">
                    @if (session('message'))
                        <div class="alert alert-success my-5">
                            {{ session('message') }}
                        </div>
                    @endif
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="text-danger"><b>Job Opportunities Available</b></p>
                        <button type="button" class="btn btn-sm btn-info mb-2" data-toggle="modal"
                            data-target="#applyJobModalCenter">
                            Drop Your CV
                        </button>
                    </div>
                        @forelse ($jobPosts->where('status',true) as $jobPost)
                            <ul class="list-group p-1">
                                <li class="list-group-item border border-danger">
                                    <a href="{{ route('home.jobPostDetails',$jobPost->id) }}" class="text-info">{{ $jobPost->title ?? '' }}</a>
                                </li>
                            </ul>
                        @empty
                            <ul class="list-group">
                                <li class="list-group-item text-danger text-center border border-danger">No Job Opportunities Available</li>
                            </ul>
                        @endforelse
               </div>

            </div>
        </div>
    </section>


    <!-- Apply Job Modal -->
    <div class="modal fade" id="applyJobModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="applyJobModalCenterCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('home.jobApply') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="exampleInputName1">Job Title</label>
                                <select name="job_post_id" class="form-control" required>
                                    <option value="">Select Job Title</option>
                                    @foreach ($jobPosts as $item)
                                        <option value="{{ $item->id }}">{{ $item->title ?? '' }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleInputName1">Full Name</label>
                                <input type="text" name="full_name" class="form-control"
                                    id="exampleInputName1" placeholder="Full Name" required>
                            </div>
                          </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="exampleInputName1">Email</label>
                                <input type="email" name="email" class="form-control"
                                    id="exampleInputName1" placeholder="Email" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleInputName1">Phone</label>
                                <input type="tel" name="phone" class="form-control" id="exampleInputName1" placeholder="Phone" required pattern="^\d{11}$" title="Phone number must be exactly 11 digits">
                            </div>
                          </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="exampleInputName1">Resume / CV</label>
                                <input type="file" name="cv" class="form-control"
                                    id="exampleInputName1" placeholder="Resume / CV" required accept=".pdf, application/pdf">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleInputName1">Add Portfolio</label>
                                <select name="portfolio_type" id="" class="form-control portfolio-type">
                                    <option value="">Select Portfolio</option>
                                    <option value="pdf">PDF</option>
                                    <option value="link">Link</option>
                                </select>
                            </div>
                          </div>
                          <div class="pdf_link_append"></div>
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
@push('frontend-script')
<script>
    $('.portfolio-type').on('change', function() {
        var selectedValue = $(this).val();
        $('.pdf_link_append').empty();
        if (selectedValue === 'pdf') {
            $('.pdf_link_append').html(`
                <div class="form-group">
                    <label for="exampleInputName1">Portfolio PDF</label>
                    <input type="file" name="portfolio" class="form-control" placeholder="Upload PDF" required accept=".pdf, application/pdf">
                </div>
            `);
        } else if (selectedValue === 'link') {
            $('.pdf_link_append').html(`
                <div class="form-group">
                    <label for="exampleInputName1">Portfolio Link</label>
                    <div class="row">
                        <div class="col-sm-8"> <input type="text" name="portfolio[]" class="form-control" placeholder="Enter your link" required></div>
                        <div class="col-sm-4"><button type="button" class="btn btn-md btn-info add-more w-100">+Add</button></div>

                    </div>
                    <div class="link-add"></div>
                </div>

            `);
        }
    });


    $(document).on('click', '.add-more', function() {
        $('.link-add').append(`
            <div class="row">
                <div class="col-sm-8"> <input type="text" name="portfolio[]" class="form-control" placeholder="Enter your link" required></div>
                <div class="col-sm-4"><button type="button" class="btn btn-md btn-danger remove-item w-100">-Remove</button></div>
            </div>
        `);
    });

    $(document).on('click', '.remove-item', function() {
        $(this).closest('.row').remove();
    });
</script>
@endpush
