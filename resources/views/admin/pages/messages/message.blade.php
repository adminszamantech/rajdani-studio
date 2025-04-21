@extends('admin.layouts.template')
@push('admin_title')
    Messages
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
        </span> Messages
    @endpush
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="mb-5 d-flex justify-content-end">
                        <a href="{{ route('messages.create') }}" class="btn btn-md btn-gradient-dark btn-icon-text">Add Message</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th> SL </th>
                                    <th> Title </th>
                                    <th> Image | Video</th>
                                    <th> Description </th>
                                    <th> Is Active </th>
                                    <th> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($messages as $message)
                                    <tr class="text-center">
                                        <td> {{ $loop->iteration }} </td>
                                        <td> {{ Str::limit($message->title, 15) ?? '' }} </td>
                                        <td class="py-1">
                                            @if ($message->type == 'image')
                                                <img src="{{ asset('/storage/admin/assets/images/message/' . $message->image_video) }}"
                                                    alt="image" />
                                            @elseif($message->type == 'video')
                                                <video width="150" controls>
                                                    <source
                                                        src="{{ asset('/storage/admin/assets/images/message/' . $message->image_video) }}"
                                                        type="video/mp4">
                                                    browser not support.
                                                </video>
                                            @endif

                                        </td>
                                        <td> {!! Str::limit(strip_tags($message->description), 20) ?? '' !!} </td>
                                        <td>
                                            @if ($message->is_active == true)
                                                <span class="badge badge-gradient-info">Active</span>
                                            @else
                                                <span class="badge badge-gradient-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2 justify-content-center">
                                                <a href="{{ route('messages.edit',$message->id) }}" class="btn btn-gradient-primary btn-rounded btn-icon d-flex justify-content-center align-items-center">
                                                    <i class="mdi mdi-pencil-outline"></i>
                                                </a>
                                                <form id="messageDeleteForm-{{ $message->id }}"
                                                    action="{{ route('messages.destroy', $message->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                        class="btn btn-gradient-primary btn-rounded btn-icon"
                                                        id="messageDeleteButton-{{ $message->id }}">
                                                        <i class="mdi mdi-delete-outline"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>

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

            $('button[id^="messageDeleteButton-"]').click(function() {
                var messageId = $(this).attr('id').split('-')[1];
                Swal.fire({
                    title: "Are you sure?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#messageDeleteForm-' + messageId).submit();
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
