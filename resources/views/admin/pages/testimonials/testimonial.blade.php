@extends('admin.layouts.template')
@push('admin_title')
    Testimonials
@endpush
@push('admin_css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endpush

@section('admin_content')
    @push('admin_breadcumb')
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span> Testimonials
    @endpush
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="mb-5 d-flex justify-content-end">
                        <a href="{{ route('testimonials.create') }}" class="btn btn-md btn-gradient-dark btn-icon-text">Add Testimonial</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th> SL </th>
                                    <th> Name </th>
                                    <th> Designation </th>
                                    <th> Comment </th>
                                    <th> Image | Video</th>
                                    <th> Review Star</th>
                                    <th> Is Active </th>
                                    <th> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($testimonials as $testimonial)
                                    <tr class="text-center">
                                        <td> {{ $loop->iteration }} </td>
                                        <td> {{ Str::limit($testimonial->name,15) ?? '' }} </td>
                                        <td> {{ $testimonial->designation ?? '' }} </td>
                                        <td> {!! Str::limit(strip_tags($testimonial->comment), 20) ?? '' !!} </td>

                                        <td class="py-1">
                                            @if ($testimonial->type == 'image')
                                                <img src="{{ asset('/storage/admin/assets/images/testimonial/' . $testimonial->image_video) }}"
                                                    alt="image" />
                                            @elseif($testimonial->type == 'video')
                                                <video width="150" controls>
                                                    <source
                                                        src="{{ asset('/storage/admin/assets/images/testimonial/' . $testimonial->image_video) }}"
                                                        type="video/mp4">
                                                    browser not support.
                                                </video>
                                            @endif

                                        </td>
                                        <td>
                                            <span class="badge badge-primary rounded"><b>{{ $testimonial->review ?? 5 }}</b></span>
                                        </td>
                                        <td>
                                            @if ($testimonial->is_active == true)
                                                <span class="badge badge-gradient-info">Active</span>
                                            @else
                                                <span class="badge badge-gradient-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2 justify-content-center">
                                                <a href="{{ route('testimonials.edit',$testimonial->id) }}" class="btn btn-gradient-primary btn-rounded btn-icon d-flex justify-content-center align-items-center">
                                                    <i class="mdi mdi-pencil-outline"></i>
                                                </a>
                                                <form id="testimonialDeleteForm-{{ $testimonial->id }}"
                                                    action="{{ route('testimonials.destroy', $testimonial->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                        class="btn btn-gradient-primary btn-rounded btn-icon"
                                                        id="testimonialDeleteButton-{{ $testimonial->id }}">
                                                        <i class="mdi mdi-delete-outline"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>

                                @empty
                                    <tr class="text-center">
                                        <td class="text-center" colspan="8">Not Found</td>
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
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script src="{{ asset('/storage/admin/assets/js/file-upload.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.summernote').summernote({
                height: 100,
                focus: true
            });

            $('button[id^="testimonialDeleteButton-"]').click(function() {
                var testimonialId = $(this).attr('id').split('-')[1];
                Swal.fire({
                    title: "Are you sure?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#testimonialDeleteForm-' + testimonialId).submit();
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
