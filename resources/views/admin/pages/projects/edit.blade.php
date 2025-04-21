@extends('admin.layouts.template')
@push('admin_title')
Edit Project
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
        </span> Edit Project
    @endpush
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('projects.update',$project->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="modal-body">

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="exampleInputName1">Project Category</label>
                                    <select class="form-select"
                                        name="project_category_id"
                                        id="exampleFormControlSelect2" required>
                                        <option value="">Select Category
                                        </option>
                                        @foreach ($projectCategories as $projectCategory)
                                            <option
                                                value="{{ $projectCategory->id ?? '' }}" @if($projectCategory->id == $project->project_category_id) selected @endif>
                                                {{ $projectCategory->name ?? '' }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="exampleInputName1">Title</label>
                                            <input type="text" name="title"
                                                class="form-control" value="{{ $project->title ?? '' }}" id="exampleInputName1"
                                                placeholder="Title" required>
                                </div>
                              </div>
                              <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="exampleInputEmail3">Description</label>
                                    <textarea name="description"  class="form-control summernote" placeholder="Description" required>{!! $project->description !!}</textarea>
                                </div>
                              </div>
                              <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="exampleInputName1">Thumbnil Image/Video</label>
                                    <select class="form-select select-file-type" name="type"
                                        id="exampleFormControlSelect2">
                                        <option value="">Select File Type</option>
                                        <option value="image">Image</option>
                                        <option value="video">Video</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="form-group file-image" style="display: none">
                                        <label>Thumbnil image upload</label>
                                        <input type="file" name="image" class="form-control" accept="image/*">
                                    </div>

                                    <div class="form-group file-video" style="display: none">
                                        <label>Thumbnil video upload</label>
                                        <input type="file" name="video" class="form-control" accept="video/*">
                                    </div>
                                </div>
                              </div>
                              <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="exampleInputName1">Multiple Image Upload</label>
                                    <input type="file" name="project_multi_images[]" class="form-control" id="exampleInputName1"
                                        placeholder="Multiple Image Upload" multiple accept="image/*">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="exampleInputName1">Status</label>
                                        <select class="form-select"
                                            name="is_active"
                                            id="exampleFormControlSelect2">
                                            <option value="1" @if($project->is_active == true) selected @endif>Active</option>
                                            <option value="0" @if($project->is_active == false) selected @endif>Inactive</option>
                                        </select>
                                </div>
                              </div>
                        </div>

                        <div class="modal-footer">
                            <a href="{{ route('projects.index') }}" type="button" class="btn btn-secondary">Close</a>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                    <div class="row my-5">
                        <div class="col-sm-2">
                            <p class="m-0"><b>Thumbnil Preview</b></p>
                            @if($project->type == 'video')
                                <video width="150" controls>
                                    <source
                                        src="{{ asset('/storage/admin/assets/images/project/' . $project->image_video) }}"
                                        type="video/mp4">
                                    browser not support.
                                </video>
                            @elseif($project->type == 'image')
                                <img style="width:100%;" src="{{ asset('/storage/admin/assets/images/project/'.$project->image_video) }}" alt="">
                            @endif
                        </div>
                        <div class="col-sm-10">
                            <p class="m-0"><b>Multiple Image Preview</b></p>
                            <div class="row">
                                @foreach ($project->project_images as $item)
                                    <div class="col-sm-2">
                                        <img style="width:90%;" src="{{ asset('/storage/admin/assets/images/project/'.$item->image) }}" alt="">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
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
                height: 200,
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
            $('button[id^="projectDeleteButton-"]').click(function() {
                var projectId = $(this).attr('id').split('-')[1];
                Swal.fire({
                    title: "Are you sure?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#projectDeleteForm-' + projectId).submit();
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




