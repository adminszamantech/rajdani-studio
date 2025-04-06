<script src="{{ asset('/storage/admin/assets/vendors/js/vendor.bundle.base.js') }}"></script>
<script src="{{ asset('/storage/admin/assets/vendors/chart.js/chart.umd.js') }}"></script>
<script src="{{ asset('/storage/admin/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('/storage/admin/assets/js/off-canvas.js') }}"></script>
<script src="{{ asset('/storage/admin/assets/js/misc.js') }}"></script>
<script src="{{ asset('/storage/admin/assets/js/settings.js') }}"></script>
<script src="{{ asset('/storage/admin/assets/js/todolist.js') }}"></script>
<script src="{{ asset('/storage/admin/assets/js/jquery.cookie.js') }}"></script>
<script src="{{ asset('/storage/admin/assets/js/dashboard.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

    @if (Session::has('message'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true
        }
        toastr.success("{{ session('message') }}");
    @endif

    @if (Session::has('error'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true
        }
        toastr.error("{{ session('error') }}");
    @endif

    @if (Session::has('info'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true
        }
        toastr.info("{{ session('info') }}");
    @endif

    @if (Session::has('warning'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true
        }
        toastr.warning("{{ session('warning') }}");
    @endif

</script>
@stack('admin_scripts')
