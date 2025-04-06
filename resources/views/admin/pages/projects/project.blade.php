@extends('admin.layouts.template')
@push('admin_title')
    Projects
@endpush
@push('admin_css')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs4.min.css" rel="stylesheet">
@endpush

@section('admin_content')
    @push('admin_breadcumb')
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span> Projects
    @endpush
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="mb-5 d-flex justify-content-end">
                        <button class="btn btn-md btn-gradient-dark btn-icon-text" data-bs-toggle="modal"
                            data-bs-target="#addprojectModal">Add Project</button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th> SL </th>
                                    <th> Category </th>
                                    <th> Title </th>
                                    <th> Image | Video</th>
                                    <th> Description </th>
                                    <th> Is Active </th>
                                    <th> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($projects as $project)
                                    <tr class="text-center">
                                        <td> {{ $loop->iteration }} </td>
                                        <td> {{ $project->project_category->name ?? '' }} </td>
                                        <td> {{ Str::limit($project->title, 15) ?? '' }} </td>
                                        <td class="py-1">
                                            @if ($project->type == 'image')
                                                <img src="{{ asset('/storage/admin/assets/images/project/' . $project->image_video) }}"
                                                    alt="image" />
                                            @elseif($project->type == 'video')
                                                <video width="150" controls>
                                                    <source
                                                        src="{{ asset('/storage/admin/assets/images/project/' . $project->image_video) }}"
                                                        type="video/mp4">
                                                    browser not support.
                                                </video>
                                            @endif

                                        </td>
                                        <td> {!! Str::limit(strip_tags($project->description), 20) ?? '' !!} </td>
                                        <td>
                                            @if ($project->is_active == true)
                                                <span class="badge badge-gradient-info">Active</span>
                                            @else
                                                <span class="badge badge-gradient-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2 justify-content-center">
                                                <button class="btn btn-gradient-primary btn-rounded btn-icon" data-bs-toggle="modal"
                                                    data-bs-target="#editprojectModal-{{ $project->id }}">
                                                    <i class="mdi mdi-pencil-outline"></i>
                                                </button>
                                                <form id="projectDeleteForm-{{ $project->id }}"
                                                    action="{{ route('projects.destroy', $project->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                        class="btn btn-gradient-primary btn-rounded btn-icon"
                                                        id="projectDeleteButton-{{ $project->id }}">
                                                        <i class="mdi mdi-delete-outline"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- edit Modal -->
                                    @if (isset($project))
                                        <div class="modal fade" id="editprojectModal-{{ $project->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <form action="{{ route('projects.update',$project->id) }}" method="post"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    @method('put')
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Edit Project</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="">
                                                                        <div class="form-group">
                                                                            <label for="exampleInputName1">Project
                                                                                Category</label>
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
                                                                        <div class="form-group">
                                                                            <label for="exampleInputName1">Title</label>
                                                                            <input type="text" name="title"
                                                                                class="form-control" value="{{ $project->title ?? '' }}" id="exampleInputName1"
                                                                                placeholder="Title" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label
                                                                                for="exampleInputEmail3">Description</label>
                                                                            <textarea name="description"  class="form-control summernote" placeholder="Description" required>{!! $project->description !!}</textarea>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <div class="py-2 d-flex justify-content-center">
                                                                                @if ($project->type == 'image')
                                                                                    <img class="w-50" src="{{ asset('/storage/admin/assets/images/project/' . $project->image_video) }}" alt="image">
                                                                                @elseif($project->type == 'video')
                                                                                    <video class="w-100" controls>
                                                                                        <source
                                                                                            src="{{ asset('/storage/admin/assets/images/project/' . $project->image_video) }}"
                                                                                            type="video/mp4">
                                                                                        browser not support.
                                                                                    </video>
                                                                                @else
                                                                                @endif

                                                                            </div>
                                                                            <label for="exampleInputName1">File Type</label>
                                                                            <select class="form-select select-file-type"
                                                                                name="type"
                                                                                id="exampleFormControlSelect2">
                                                                                <option value="">Select File Type
                                                                                </option>
                                                                                <option value="image">Image</option>
                                                                                <option value="video">Video</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group file-image"
                                                                            style="display: none">
                                                                            <label>Image File upload</label>
                                                                            <input type="file" name="image"
                                                                                class="form-control" accept="image/*">
                                                                        </div>

                                                                        <div class="form-group file-video"
                                                                            style="display: none">
                                                                            <label>Video File upload</label>
                                                                            <input type="file" name="video"
                                                                                class="form-control" accept="video/*">
                                                                        </div>
                                                                        <div class="form-group">
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
    <div class="modal fade" id="addprojectModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form action="{{ route('projects.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Project</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="">
                                    <div class="form-group">
                                        <label for="exampleInputName1">Project Category</label>
                                        <select class="form-select" name="project_category_id"
                                            id="exampleFormControlSelect2" required>
                                            <option value="">Select Category</option>
                                            @foreach ($projectCategories as $projectCategory)
                                                <option value="{{ $projectCategory->id ?? '' }}">
                                                    {{ $projectCategory->name ?? '' }}</option>
                                            @endforeach
                                        </select>
                                    </div>
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
                                        <label for="exampleInputName1">File Type</label>
                                        <select class="form-select select-file-type" name="type"
                                            id="exampleFormControlSelect2" required>
                                            <option value="">Select File Type</option>
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
