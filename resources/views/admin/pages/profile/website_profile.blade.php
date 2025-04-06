@extends('admin.layouts.template')
@push('admin_title')
    Website Settings
@endpush
@section('admin_content')
    @push('admin_breadcumb')
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span> Website Settings
    @endpush

    <div class="row">
        <div class="col-12 col-md-6 grid-margin stretch-card">
            <div class="card">
                <form action="{{ route('websiteSetting') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputPhone">Phone</label>
                            <input type="number" name="phone" value="{{ $setting->phone ?? '' }}" class="form-control" id="exampleInputPhone"
                                value="" placeholder="Enter Phone" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail3">Email address</label>
                            <input type="email" name="email" value="{{ $setting->email ?? '' }}" class="form-control" id="exampleInputEmail3"
                                value="" placeholder="Enter Email" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputAddress">Address</label>
                            <input type="text" name="address" value="{{ $setting->address ?? '' }}" class="form-control" id="exampleInputAddress"
                                placeholder="Enter Address" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFbLink">Facebook Link</label>
                            <input type="text" name="facebook_link" value="{{ $setting->facebook_link ?? '' }}" class="form-control" id="exampleInputFbLink"
                                placeholder="Enter Facebook Link" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputLdLink">Linkedin Link</label>
                            <input type="text" name="linkedin_link" value="{{ $setting->linkedin_link ?? '' }}" class="form-control" id="exampleInputLdLink"
                                placeholder="Enter Linkedin Link" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputTwLink">Whatsapp Number</label>
                            <input type="text" name="whatsapp_number" value="{{ $setting->whatsapp_number ?? '' }}" class="form-control" id="exampleInputTwLink"
                                placeholder="Enter Whatsapp Number" required>
                        </div>
                        <div class="form-group">
                            <label>Logo upload</label>
                            <input type="file" name="logo_image" class="file-upload-default">
                            <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info" disabled placeholder="Logo Upload">
                                <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-gradient-secondary py-3"
                                        type="button">Upload</button>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Favicon upload</label>
                            <input type="file" name="favicon_image" class="file-upload-default">
                            <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info" disabled placeholder="Favicon upload">
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
