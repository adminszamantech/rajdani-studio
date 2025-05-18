@extends('admin.layouts.template')
@push('admin_title')
Edit Testimonial
@endpush
@push('admin_css')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
@endpush

@section('admin_content')
    @push('admin_breadcumb')
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span> Edit Testimonial
    @endpush
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <form action="{{ route('testimonials.update',$testimonial->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="">
                                        <div class="form-group">
                                            <label for="exampleInputName1">Name</label>
                                            <input type="text" name="name"
                                                class="form-control" value="{{ $testimonial->name ?? '' }}" id="exampleInputName1"
                                                placeholder="Name" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputName1">Designation</label>
                                            <input type="text" name="designation"
                                                class="form-control" value="{{ $testimonial->designation ?? '' }}" id="exampleInputName1"
                                                placeholder="Designation" required>
                                        </div>
                                        <div class="form-group">
                                            <label
                                                for="exampleInputEmail3">Comment</label>
                                            <textarea name="comment" class="form-control textarea" placeholder="Comment">{!! strip_tags($testimonial->comment) !!}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputName1">Review Start</label>
                                            <input type="number" name="review"
                                                class="form-control" id="exampleInputName1"
                                                placeholder="Review Start" value="{{ $testimonial->review }}" required max="5">
                                        </div>
                                        <div class="form-group">
                                            <div class="py-2">
                                                @if ($testimonial->type == 'image')
                                                    <img style="width: 10%; height:100px;" src="{{ asset('/storage/admin/assets/images/testimonial/' . $testimonial->image_video) }}" alt="image">
                                                @elseif($testimonial->type == 'video')
                                                    <video class="w-100" controls>
                                                        <source
                                                            src="{{ asset('/storage/admin/assets/images/testimonial/' . $testimonial->image_video) }}"
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
                                                <option value="1" @if($testimonial->is_active == true) selected @endif>Active</option>
                                                <option value="0" @if($testimonial->is_active == false) selected @endif>Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a href="{{ route('testimonials.index') }}" class="btn btn-secondary">Close</a>
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
    <script src="{{ asset('/storage/admin/assets/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('/storage/admin/assets/js/file-upload.js') }}"></script>
    <script>
        $(document).ready(function() {

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


        tinymce.init({
        selector: '.textarea',
        plugins: 'advlist autolink lists textcolor colorpicker link code wordcount searchreplace charmap anchor visualblocks fullscreen table contextmenu paste',
        menubar: true,
        height: "200",
        toolbar1: 'insertfile | bold italic underline fontsizeselect fontselect | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | forecolor backcolor link code',
        fontsize_formats: "1pt 2pt 3pt 4pt 5pt 6pt 7pt 8pt 9pt 10pt 11pt 12pt 13pt 14pt 15pt 16pt 17pt 18pt 19pt 20pt 21pt 22pt 23pt 24pt 25pt 26pt 27pt 28pt 29pt 30pt 31pt 32pt 33pt 34pt 35pt 36pt 37pt 38pt 39pt 40pt 41pt 42pt 43pt 44pt 45pt 46pt 47pt 48pt 49pt 50pt",
        font_formats:
            "Arial=arial,helvetica,sans-serif;" +
            "Arial Black=arial black,avant garde;" +
            "Comic Sans MS=comic sans ms,sans-serif;" +
            "Courier New=courier new,courier,monospace;" +
            "Georgia=georgia,palatino;" +
            "Impact=impact,chicago;" +
            "Lucida Console=lucida console,monaco,monospace;" +
            "Lucida Sans Unicode=lucida sans unicode,lucida grande,sans-serif;" +
            "Palatino Linotype=palatino linotype,book antiqua,palatino,serif;" +
            "Segoe UI=segoe ui,sans-serif;" +
            "Tahoma=tahoma,arial,helvetica,sans-serif;" +
            "Times New Roman=times new roman,times,serif;" +
            "Trebuchet MS=trebuchet ms,geneva,sans-serif;" +
            "Verdana=verdana,geneva,sans-serif;" +
            "Helvetica=helvetica;" +
            "Gill Sans=gill sans,gill sans mt,calibri,sans-serif;" +
            "Calibri=calibri,candara,Segoe,Segoe UI,Optima,Arial,sans-serif;" +
            "Cambria=cambria,georgia,serif;" +
            "Garamond=garamond,baskerville,serif;" +
            "Bookman=bookman,serif;" +
            "Avant Garde=avant garde,sans-serif;" +
            "Century Gothic=century gothic,apple gothic,sans-serif;" +
            "Franklin Gothic Medium=franklin gothic medium,arial black,sans-serif;" +
            "Candara=candara,calibri,Segoe,Segoe UI,Optima,Arial,sans-serif;" +
            "Optima=optima,segoe,segoe ui,candara,calibri,arial,sans-serif;" +
            "Futura=futura,sans-serif;" +
            "Rockwell=rockwell,serif;" +
            "Baskerville=baskerville,serif;" +
            "Didot=didot,serif;" +
            "Perpetua=perpetua,serif;" +
            "Big Caslon=big caslon,serif;" +
            "Consolas=consolas,monaco,monospace;" +
            "Monaco=monaco,consolas,monospace;" +
            "Ubuntu=ubuntu,sans-serif;" +
            "Roboto=roboto,arial,sans-serif;" +
            "Open Sans=open sans,arial,sans-serif;" +
            "Lato=lato,arial,sans-serif;" +
            "Raleway=raleway,arial,sans-serif;" +
            "PT Sans=pt sans,arial,sans-serif;" +
            "Noto Sans=noto sans,arial,sans-serif;" +
            "Noto Serif=noto serif,serif;",
        rel_list: [
            { title: 'nofollow', value: 'nofollow' },
            { title: 'follow', value: 'follow' }
        ],
        media_live_embeds: false,
        relative_urls: false,
        remove_script_host: false,
        extended_valid_elements: 'script[type|src|charset]'
        });
    </script>
@endpush
