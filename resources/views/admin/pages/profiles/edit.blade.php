@extends('admin.layouts.template')
@push('admin_title')
    Edit Profile
@endpush
@push('admin_css')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs4.min.css" rel="stylesheet">
@endpush

@section('admin_content')
    @push('admin_breadcumb')
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span> Edit Profile
    @endpush
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('profiles.update', $profile->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="">
                                        <div class="form-group">
                                            <label for="exampleInputName1">Title</label>
                                            <input type="text" name="title" class="form-control"
                                                value="{{ $profile->title ?? '' }}" id="exampleInputName1"
                                                placeholder="Title" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail3">Description</label>
                                            <textarea name="description" class="form-control summernote" placeholder="Description" required>{!! $profile->description !!}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <div class="py-2">
                                                @if ($profile->type == 'image')
                                                    <img style="width: 12%; height:100px;"
                                                        src="{{ asset('/storage/admin/assets/images/profile/' . $profile->image_video) }}"
                                                        alt="image">
                                                @elseif($profile->type == 'video')
                                                    <video class="w-100" controls>
                                                        <source
                                                            src="{{ asset('/storage/admin/assets/images/profile/' . $profile->image_video) }}"
                                                            type="video/mp4">
                                                        browser not support.
                                                    </video>
                                                @else
                                                @endif

                                            </div>
                                            <label for="exampleInputName1">File Type</label>
                                            <select class="form-select select-file-type" name="type"
                                                id="exampleFormControlSelect2">
                                                <option value="">Select File Type
                                                </option>
                                                <option value="image">Image</option>
                                                <option value="video">Video</option>
                                            </select>
                                        </div>
                                        <div class="form-group file-image" style="display: none">
                                            <label>Image File upload</label>
                                            <input type="file" name="image" class="form-control" accept="image/*">
                                        </div>

                                        <div class="form-group file-video" style="display: none">
                                            <label>Video File upload</label>
                                            <input type="file" name="video" class="form-control" accept="video/*">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputName1">Status</label>
                                            <select class="form-select" name="is_active" id="exampleFormControlSelect2">
                                                <option value="1"
                                                    @if ($profile->is_active == true) selected @endif>Active</option>
                                                <option value="0"
                                                    @if ($profile->is_active == false) selected @endif>Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a href="{{ route('profiles.index') }}" class="btn btn-secondary">Close</a>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>

                </div>
            </div>
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
                height: 150,
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

            $('button[id^="profileDeleteButton-"]').click(function() {
                var profileId = $(this).attr('id').split('-')[1];
                Swal.fire({
                    title: "Are you sure?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#profileDeleteForm-' + profileId).submit();
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
