@extends('admin.layouts.template')
@push('admin_title')
    Job Posts
@endpush
@push('admin_css')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs4.min.css" rel="stylesheet">
@endpush

@section('admin_content')
    @push('admin_breadcumb')
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span> Job Posts
    @endpush
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="mb-5 d-flex justify-content-end">
                        <button class="btn btn-md btn-gradient-dark btn-icon-text" data-bs-toggle="modal"
                            data-bs-target="#addjob_postModal">Add Job Post</button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th> SL </th>
                                    <th> Title </th>
                                    <th> Description </th>
                                    <th> Deadline </th>
                                    <th> Status </th>
                                    <th> TotalApplied </th>
                                    <th> Unseen </th>
                                    <th> Seen </th>
                                    <th> Shortlist </th>
                                    <th> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($job_posts as $job_post)
                                    <tr class="text-center">
                                        <td> {{ $loop->iteration }} </td>
                                        <td> {{ Str::limit($job_post->title, 20) ?? '' }} </td>
                                        <td> {!! Str::limit(strip_tags($job_post->description), 30) ?? '' !!} </td>
                                        <td> {{ Carbon\Carbon::parse($job_post->deadline)->format('Y-m-d h:i A') ?? '' }} </td>
                                        <td>
                                            @if ($job_post->status == true)
                                                <span class="badge badge-gradient-info">Active</span>
                                            @else
                                                <span class="badge badge-gradient-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td> {{ count($job_post->job_applied) }} </td>
                                        <td>  {{ $job_post->job_applied->where('seen', 0)->count() }} </td>
                                        <td> {{ $job_post->job_applied->where('seen', 1)->count() }} </td>
                                        <td>  {{ $job_post->job_applied->where('seen', 2)->count() }} </td>
                                        <td>
                                            <div class="d-flex gap-2 justify-content-center">
                                                <a href="{{ route('jobAppliedLists',$job_post->id) }}" class="btn btn-gradient-primary btn-rounded btn-icon d-flex justify-content-center align-items-center">
                                                    <i class="mdi mdi-book-open"></i>
                                                </a>
                                                <button class="btn btn-gradient-primary btn-rounded btn-icon" data-bs-toggle="modal"
                                                    data-bs-target="#editjob_postModal-{{ $job_post->id }}">
                                                    <i class="mdi mdi-pencil-outline"></i>
                                                </button>
                                                <form id="job_postDeleteForm-{{ $job_post->id }}"
                                                    action="{{ route('job-posts.destroy', $job_post->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                        class="btn btn-gradient-primary btn-rounded btn-icon"
                                                        id="job_postDeleteButton-{{ $job_post->id }}">
                                                        <i class="mdi mdi-delete-outline"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- edit Modal -->
                                    @if (isset($job_post))
                                        <div class="modal fade" id="editjob_postModal-{{ $job_post->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <form action="{{ route('job-posts.update',$job_post->id) }}" method="post"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    @method('put')
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Edit job_post</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="">
                                                                        <div class="form-group">
                                                                            <label for="exampleInputName1">Title</label>
                                                                            <input type="text" name="title"
                                                                                class="form-control" value="{{ $job_post->title ?? '' }}" id="exampleInputName1"
                                                                                placeholder="Title" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label
                                                                                for="exampleInputEmail3">Description</label>
                                                                            <textarea name="description" class="form-control summernote" placeholder="Description" required>{!! $job_post->description !!}</textarea>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="exampleInputName1">Deadline</label>
                                                                            <input type="datetime-local" name="deadline" value="{{ $job_post->deadline }}" class="form-control" id="exampleInputName1"
                                                                                placeholder="Deadline" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="exampleInputName1">Status</label>
                                                                            <select class="form-select"
                                                                                name="status"
                                                                                id="exampleFormControlSelect2">
                                                                                <option value="1" @if($job_post->status == true) selected @endif>Active</option>
                                                                                <option value="0" @if($job_post->status == false) selected @endif>Inactive</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Update</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    @endif
                                @empty
                                    <tr class="text-center">
                                        <td class="text-center" colspan="7">Not Found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- add Modal -->
    <div class="modal fade" id="addjob_postModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form action="{{ route('job-posts.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Job Post</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="">
                                    <div class="form-group">
                                        <label for="exampleInputName1">Title</label>
                                        <input type="text" name="title" class="form-control" id="exampleInputName1"
                                            placeholder="Title" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail3">Description</label>
                                        <textarea name="description" class="form-control summernote" placeholder="Description" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputName1">Deadline</label>
                                        <input type="datetime-local" name="deadline" class="form-control" id="exampleInputName1"
                                            placeholder="Deadline" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputName1">Status</label>
                                        <select class="form-select"
                                            name="status"
                                            id="exampleFormControlSelect2">
                                            <option value="1" selected>Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('admin_scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs4.min.js"></script>
    <script src="{{ asset('/storage/admin/assets/js/file-upload.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.summernote').summernote({
                placeholder: 'Type Here...',
                tabsize: 2,
                height: 250,
                toolbar: [
                    // Basic style options
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['fontname', 'fontsize', 'strikethrough', 'superscript', 'subscript']],
                    ['para', ['ul', 'ol', 'paragraph', 'height', 'style']],
                    ['align', ['left', 'center', 'right', 'justify']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']],
                    ['color', ['forecolor', 'backcolor']],
                    ['table', ['table']],
                    ['misc', ['undo', 'redo']]
                ]
            });

            $('button[id^="job_postDeleteButton-"]').click(function() {
                var job_postId = $(this).attr('id').split('-')[1];
                Swal.fire({
                    title: "Are you sure?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#job_postDeleteForm-' + job_postId).submit();
                    }
                });
            });

            $('.select-file-type').change(function() {
                var fileType = $(this).val();
                $('.file-image, .file-video').hide();
                if (fileType === 'image') {
                    $('.file-image').show();
                } else if (fileType === 'video') {
                    $('.file-video').show();
                }
            });

        });
    </script>
@endpush
