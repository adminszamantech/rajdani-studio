<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>@stack('admin_title')</title>
<link rel="stylesheet" href="{{ asset('/storage/admin/assets/vendors/mdi/css/materialdesignicons.min.css') }}">
<link rel="stylesheet" href="{{ asset('/storage/admin/assets/vendors/ti-icons/css/themify-icons.css') }}">
<link rel="stylesheet" href="{{ asset('/storage/admin/assets/vendors/css/vendor.bundle.base.css') }}">
<link rel="stylesheet" href="{{ asset('/storage/admin/assets/vendors/font-awesome/css/font-awesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('/storage/admin/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('/storage/admin/assets/css/style.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<link rel="shortcut icon" href="@if(website()->favicon_image) {{ asset('/storage/admin/assets/images/logo/'.website()->favicon_image) }} @else {{ asset('/storage/admin/assets/images/favicon.png') }} @endif" />
<style>
    .navbar .navbar-brand-wrapper .navbar-brand img {
        height: 51px;
    }
</style>
@stack('admin_css')
