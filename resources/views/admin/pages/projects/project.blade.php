@extends('admin.layouts.template')
@push('admin_title')
    Projects
@endpush
@push('admin_css')

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
                        <a href="{{ route('projects.create') }}" class="btn btn-md btn-gradient-dark btn-icon-text">Add Project</a>
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
                                                <a href="{{ route('projects.edit',$project->id) }}" class="btn btn-gradient-primary btn-rounded btn-icon d-flex justify-content-center align-items-center">
                                                    <i class="mdi mdi-pencil-outline"></i>
                                                </a>
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
                                @empty
                                    <tr class="text-center">
                                        <td class="text-center" colspan="7">Not Found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {!! $projects->links('pagination::bootstrap-4') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('admin_scripts')
    <script>
        $(document).ready(function() {
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

        });
    </script>
@endpush
