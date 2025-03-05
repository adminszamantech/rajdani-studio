@extends('admin.layouts.template')
@push('admin_title')
    Galleries
@endpush
@push('admin_css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endpush

@section('admin_content')
    @push('admin_breadcumb')
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span> Galleries
    @endpush
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="mb-5 d-flex justify-content-end">
                        <button class="btn btn-md btn-gradient-dark btn-icon-text" data-bs-toggle="modal"
                            data-bs-target="#addgalleryModal">Add Gallery</button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th> SL </th>
                                    {{-- <th> Title </th> --}}
                                    <th> Image | Video</th>
                                    {{-- <th> Description </th> --}}
                                    <th> Is Active </th>
                                    <th> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($galleries as $gallery)
                                    <tr class="text-center">
                                        <td> {{ $loop->iteration }} </td>
                                        {{-- <td> {{ Str::limit($gallery->title, 15) ?? '' }} </td> --}}
                                        <td class="py-1">
                                            @if ($gallery->type == 'image')
                                                <img src="{{ asset('/storage/admin/assets/images/gallery/' . $gallery->image_video) }}"
                                                    alt="image" />
                                            @elseif($gallery->type == 'video')
                                                <video width="150" controls>
                                                    <source
                                                        src="{{ asset('/storage/admin/assets/images/gallery/' . $gallery->image_video) }}"
                                                        type="video/mp4">
                                                    browser not support.
                                                </video>
                                            @endif

                                        </td>
                                        {{-- <td> {!! Str::limit(strip_tags($gallery->description), 20) ?? '' !!} </td> --}}
                                        <td>
                                            @if ($gallery->is_active == true)
                                                <span class="badge badge-gradient-info">Active</span>
                                            @else
                                                <span class="badge badge-gradient-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2 justify-content-center">
                                                <button class="btn btn-gradient-primary btn-rounded btn-icon" data-bs-toggle="modal"
                                                    data-bs-target="#editgalleryModal-{{ $gallery->id }}">
                                                    <i class="mdi mdi-pencil-outline"></i>
                                                </button>
                                                <form id="galleryDeleteForm-{{ $gallery->id }}"
                                                    action="{{ route('galleries.destroy', $gallery->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                        class="btn btn-gradient-primary btn-rounded btn-icon"
                                                        id="galleryDeleteButton-{{ $gallery->id }}">
                                                        <i class="mdi mdi-delete-outline"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- edit Modal -->
                                    @if (isset($gallery))
                                        <div class="modal fade" id="editgalleryModal-{{ $gallery->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <form action="{{ route('galleries.update',$gallery->id) }}" method="post"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    @method('put')
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Edit Gallery</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="">
                                                                        {{-- <div class="form-group">
                                                                            <label for="exampleInputName1">Title</label>
                                                                            <input type="text" name="title"
                                                                                class="form-control" value="{{ $gallery->title ?? '' }}" id="exampleInputName1"
                                                                                placeholder="Title" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label
                                                                                for="exampleInputEmail3">Description</label>
                                                                            <textarea name="description"  class="form-control summernote" placeholder="Description" required>{!! $gallery->description !!}</textarea>
                                                                        </div> --}}
                                                                        <div class="form-group">
                                                                            <div class="py-2">
                                                                                @if ($gallery->type == 'image')
                                                                                    <img class="w-100" style="height: 180px" src="{{ asset('/storage/admin/assets/images/gallery/' . $gallery->image_video) }}" alt="image">
                                                                                @elseif($gallery->type == 'video')
                                                                                    <video class="w-100" controls>
                                                                                        <source
                                                                                            src="{{ asset('/storage/admin/assets/images/gallery/' . $gallery->image_video) }}"
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
                                                                                <option value="1" @if($gallery->is_active == true) selected @endif>Active</option>
                                                                                <option value="0" @if($gallery->is_active == false) selected @endif>Inactive</option>
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
    <div class="modal fade" id="addgalleryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('galleries.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Gallery</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="">
                                    {{-- <div class="form-group">
                                        <label for="exampleInputName1">Title</label>
                                        <input type="text" name="title" class="form-control" id="exampleInputName1"
                                            placeholder="Title" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail3">Description</label>
                                        <textarea name="description" id="addSummernote" class="form-control" placeholder="Description" required></textarea>
                                    </div> --}}
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
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script src="{{ asset('/storage/admin/assets/js/file-upload.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#addSummernote').summernote({
                height: 100,
                focus: true
            });
            $('.summernote').summernote({
                height: 100,
                focus: true
            });

            $('button[id^="galleryDeleteButton-"]').click(function() {
                var galleryId = $(this).attr('id').split('-')[1];
                Swal.fire({
                    title: "Are you sure?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#galleryDeleteForm-' + galleryId).submit();
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
