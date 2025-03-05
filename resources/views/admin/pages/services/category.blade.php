@extends('admin.layouts.template')
@push('admin_title')
    Service Categories
@endpush
@push('admin_css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endpush

@section('admin_content')
    @push('admin_breadcumb')
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span> Service Categories
    @endpush
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="mb-5 d-flex justify-content-end">
                        <button class="btn btn-md btn-gradient-dark btn-icon-text" data-bs-toggle="modal"
                            data-bs-target="#addserviceCategoryModal">Add Service Category</button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th> SL </th>
                                    <th> Name </th>
                                    <th> Is Active </th>
                                    <th> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($serviceCategories as $serviceCategory)
                                    <tr class="text-center">
                                        <td> {{ $loop->iteration }} </td>
                                        <td> {{ $serviceCategory->name ?? '' }} </td>
                                        <td>
                                            @if ($serviceCategory->is_active == true)
                                                <span class="badge badge-gradient-info">Active</span>
                                            @else
                                                <span class="badge badge-gradient-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2 justify-content-center">
                                                <button class="btn btn-gradient-primary btn-rounded btn-icon" data-bs-toggle="modal"
                                                    data-bs-target="#editserviceCategoryModal-{{ $serviceCategory->id }}">
                                                    <i class="mdi mdi-pencil-outline"></i>
                                                </button>
                                                {{-- <form id="serviceCategoryDeleteForm-{{ $serviceCategory->id }}"
                                                    action="{{ route('service-categories.destroy', $serviceCategory->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                        class="btn btn-gradient-primary btn-rounded btn-icon"
                                                        id="serviceCategoryDeleteButton-{{ $serviceCategory->id }}">
                                                        <i class="mdi mdi-delete-outline"></i>
                                                    </button>
                                                </form> --}}
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- edit Modal -->
                                    @if (isset($serviceCategory))
                                        <div class="modal fade" id="editserviceCategoryModal-{{ $serviceCategory->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <form action="{{ route('service-categories.update',$serviceCategory->id) }}" method="post"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    @method('put')
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Edit Service Category</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="">
                                                                        <div class="form-group">
                                                                            <label for="exampleInputName1">Name</label>
                                                                            <input type="text" name="name"
                                                                                class="form-control" value="{{ $serviceCategory->name ?? '' }}" id="exampleInputName1"
                                                                                placeholder="Name" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="exampleInputName1">Status</label>
                                                                            <select class="form-select"
                                                                                name="is_active"
                                                                                id="exampleFormControlSelect2">
                                                                                <option value="1" @if($serviceCategory->is_active == true) selected @endif>Active</option>
                                                                                <option value="0" @if($serviceCategory->is_active == false) selected @endif>Inactive</option>
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
    <div class="modal fade" id="addserviceCategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('service-categories.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Service Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="">
                                    <div class="form-group">
                                        <label for="exampleInputName1">Name</label>
                                        <input type="text" name="name" class="form-control" id="exampleInputName1"
                                            placeholder="Name" required>
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
    <script>
        // $(document).ready(function() {
        //     $('button[id^="serviceCategoryDeleteButton-"]').click(function() {
        //         var serviceCategoryId = $(this).attr('id').split('-')[1];
        //         Swal.fire({
        //             title: "Are you sure?",
        //             icon: "warning",
        //             showCancelButton: true,
        //             confirmButtonColor: "#3085d6",
        //             cancelButtonColor: "#d33",
        //             confirmButtonText: "Yes, delete it!"
        //         }).then((result) => {
        //             if (result.isConfirmed) {
        //                 $('#serviceCategoryDeleteForm-' + serviceCategoryId).submit();
        //             }
        //         });
        //     });

        // });
    </script>
@endpush
