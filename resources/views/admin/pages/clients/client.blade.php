@extends('admin.layouts.template')
@push('admin_title')
    Clients
@endpush
@section('admin_content')
    @push('admin_breadcumb')
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span> Clients
    @endpush
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="mb-5 d-flex justify-content-end">
                        <button class="btn btn-md btn-gradient-dark btn-icon-text" data-bs-toggle="modal"
                            data-bs-target="#addclientModal">Add Client</button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th> SL </th>
                                    <th> Image </th>
                                    <th> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clients as $client)
                                    <tr class="text-center">
                                        <td> {{ $loop->iteration }}</td>
                                        <td class="py-1">
                                            @if ($client->image)
                                                <img style="width:100%;object-fit:contain" src="{{ asset('/storage/frontend/img/client/' . $client->image) }}"
                                                    alt="image" />
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2 justify-content-center">
                                                <button type="button" class="btn btn-gradient-primary btn-rounded btn-icon"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editclientModal-{{ $client->id }}">
                                                    <i class="mdi mdi-pencil-outline"></i>
                                                </button>
                                                <form id="clientDeleteForm-{{ $client->id }}"
                                                    action="{{ route('clients.destroy', $client->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                        class="btn btn-gradient-primary btn-rounded btn-icon"
                                                        id="clientDeleteButton-{{ $client->id }}">
                                                        <i class="mdi mdi-delete-outline"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- edit Modal -->
                                    @if (isset($client))
                                        <div class="modal fade" id="editclientModal-{{ $client->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <form action="{{ route('clients.update', $client->id) }}" method="post"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    @method('put')
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Edit Client</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="">
                                                                        <div class="form-group">
                                                                            <label>File upload</label>
                                                                            <input type="file" name="image"
                                                                                class="file-upload-default" required>
                                                                            <div class="input-group col-xs-12">
                                                                                <input type="text"
                                                                                    class="form-control file-upload-info"
                                                                                    disabled placeholder="Upload Image">
                                                                                <span class="input-group-append">
                                                                                    <button
                                                                                        class="file-upload-browse btn btn-gradient-secondary py-3"
                                                                                        type="button">Upload</button>
                                                                                </span>
                                                                            </div>
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
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- add Modal -->
    <div class="modal fade" id="addclientModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('clients.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Client</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="">
                                    <div class="form-group">
                                        <label>File upload</label>
                                        <input type="file" name="image" class="file-upload-default" required>
                                        <div class="input-group col-xs-12">
                                            <input type="text" class="form-control file-upload-info" disabled
                                                placeholder="Upload Image">
                                            <span class="input-group-append">
                                                <button class="file-upload-browse btn btn-gradient-secondary py-3"
                                                    type="button">Upload</button>
                                            </span>
                                        </div>
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
    <script src="{{ asset('/storage/admin/assets/js/file-upload.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('button[id^="clientDeleteButton-"]').click(function() {
                var clientId = $(this).attr('id').split('-')[1];
                Swal.fire({
                    title: "Are you sure?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#clientDeleteForm-' + clientId).submit();
                    }
                });
            });
        });
    </script>
@endpush
