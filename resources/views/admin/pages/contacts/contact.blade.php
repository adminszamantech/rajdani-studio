@extends('admin.layouts.template')
@push('admin_title')
    Contacts
@endpush
@push('admin_css')
@endpush

@section('admin_content')
    @push('admin_breadcumb')
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span> Contacts
    @endpush
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th> SL </th>
                                    <th> Name </th>
                                    <th> Email </th>
                                    <th> Phone </th>
                                    <th> Subject </th>
                                    <th> Message </th>
                                    <th> Is Active </th>
                                    <th> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($contacts as $contact)
                                    <tr class="text-center">
                                        <td> {{ $loop->iteration }} </td>
                                        <td> {{ $contact->name ?? '' }} </td>
                                        <td> {{ $contact->email ?? '' }} </td>
                                        <td> {{ $contact->phone ?? '' }} </td>
                                        <td> {{ Str::limit($contact->subject,15) ?? '' }} </td>

                                        <td> {!! Str::limit(strip_tags($contact->message), 20) ?? '' !!} </td>
                                        <td>
                                            @if ($contact->is_active == true)
                                                <span class="badge badge-gradient-info">Active</span>
                                            @else
                                                <span class="badge badge-gradient-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2 justify-content-center">
                                                <button class="btn btn-gradient-primary btn-rounded btn-icon" data-bs-toggle="modal"
                                                    data-bs-target="#viewcontactModal-{{ $contact->id }}">
                                                    <i class="mdi mdi-eye-outline"></i>
                                                </button>
                                                <form id="contactDeleteForm-{{ $contact->id }}"
                                                    action="{{ route('contacts.destroy', $contact->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                        class="btn btn-gradient-primary btn-rounded btn-icon"
                                                        id="contactDeleteButton-{{ $contact->id }}">
                                                        <i class="mdi mdi-delete-outline"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- view Modal -->
                                    @if (isset($contact))
                                        <div class="modal fade" id="viewcontactModal-{{ $contact->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <form action="{{ route('contacts.update',$contact->id) }}" method="post"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    @method('put')
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">View Contact</h5>
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
                                                                                class="form-control" value="{{ $contact->name ?? '' }}" id="exampleInputName1"
                                                                                placeholder="Name">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="exampleInputName1">Email</label>
                                                                            <input type="text" name="email"
                                                                                class="form-control" value="{{ $contact->email ?? '' }}" id="exampleInputName1"
                                                                                placeholder="Email">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="exampleInputName1">Phone</label>
                                                                            <input type="text" name="phone"
                                                                                class="form-control" value="{{ $contact->phone ?? '' }}" id="exampleInputName1"
                                                                                placeholder="Phone">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="exampleInputName1">Subject</label>
                                                                            <input type="text" name="subject"
                                                                                class="form-control" value="{{ $contact->subject ?? '' }}" id="exampleInputName1"
                                                                                placeholder="Subject">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="exampleInputName1">Message</label>
                                                                            <textarea name="" id="" class="form-control" cols="30" rows="10">{{ $contact->message ?? '' }}</textarea>
                                                                        </div>



                                                                        <div class="form-group">
                                                                            <label for="exampleInputName1">Status</label>
                                                                            <select class="form-select"
                                                                                name="is_active"
                                                                                id="exampleFormControlSelect2">
                                                                                <option value="1" @if($contact->is_active == true) selected @endif>Active</option>
                                                                                <option value="0" @if($contact->is_active == false) selected @endif>Inactive</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary"
                                                                data-bs-dismiss="modal">Update</button>
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

@endsection

@push('admin_scripts')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script>
        $(document).ready(function() {


            $('button[id^="contactDeleteButton-"]').click(function() {
                var contactId = $(this).attr('id').split('-')[1];
                Swal.fire({
                    title: "Are you sure?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#contactDeleteForm-' + contactId).submit();
                    }
                });
            });
        });
    </script>
@endpush
