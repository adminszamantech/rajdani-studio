@extends('admin.layouts.template')
@push('admin_title')
    Profile Settings
@endpush
@section('admin_content')
    @push('admin_breadcumb')
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span> Profile Settings
    @endpush
    <div class="row">
        <div class="col-12 col-md-6 grid-margin stretch-card">
            <div class="card">
                <form action="{{ route('profileSetting') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                            <img src=" @if($user->profile_image) {{ asset('/storage/admin/assets/images/profile/'.$user->profile_image) }} @else {{ asset('/storage/admin/assets/images/faces/face1.jpg') }} @endif" class="rounded-circle"
                                alt="profile-image">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName1">Name</label>
                            <input type="text" name="name" class="form-control" id="exampleInputName1"
                                value="{{ $user->name ?? '' }}" placeholder="Name" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail3">Email address</label>
                            <input type="email" name="email" class="form-control" id="exampleInputEmail3"
                                value="{{ $user->email ?? '' }}" placeholder="Email" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword4">Password</label>
                            <input type="password" name="password" class="form-control" id="exampleInputPassword4"
                                placeholder="Password" min="4">
                        </div>
                        <div class="form-group">
                            <label>File upload</label>
                            <input type="file" name="profile_image" class="file-upload-default">
                            <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info" disabled
                                    placeholder="Upload Image">
                                <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-gradient-secondary py-3"
                                        type="button">Upload</button>
                                </span>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-gradient-primary float-end mb-5">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('admin_scripts')
    <script src="{{ asset('/storage/admin/assets/js/file-upload.js') }}"></script>
@endpush
