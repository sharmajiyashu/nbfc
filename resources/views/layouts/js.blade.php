<!-- BEGIN: Vendor JS-->
{{-- <script src="{{ asset('public/admin/app-assets/vendors/js/vendors.min.js')}}"></script> --}}
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="{{ asset('public/admin/app-assets/vendors/js/charts/apexcharts.min.js')}}"></script>
<script src="{{ asset('public/admin/app-assets/vendors/js/extensions/toastr.min.js')}}"></script>
<!-- END: Page Vendor JS-->



<!-- BEGIN: Theme JS-->
<script src="{{ asset('public/admin/app-assets/js/core/app-menu.js')}}"></script>
<script src="{{ asset('public/admin/app-assets/js/core/app.js')}}"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
<script src="{{ asset('public/admin/app-assets/js/scripts/pages/dashboard-ecommerce.js')}}"></script>

<script src="{{ asset('public/admin/app-assets/vendors/js/vendors.min.js')}}"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="{{ asset('public/admin/app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>

<script src="{{ asset('public/sweet-alert/sweet.min.js') }}"></script>



<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="{{ asset('public/admin/app-assets/js/core/app-menu.js')}}"></script>
<script src="{{ asset('public/admin/app-assets/js/core/app.js')}}"></script>
<!-- END: Page JS-->

<script>
    $(window).on('load', function() {
        if (feather) {
            feather.replace({
                width: 14,
                height: 14
            });
        }
    })

    
</script>


@if (session('success'))
    <script>
        Swal.fire({
            title: 'Success!',
            text: '{{ session('success') }}',
            icon: 'success',
            confirmButtonText: 'OK'
        }); 

        var audio = new Audio('{{ asset('public/sweet-alert/success.mp3') }}'); // Adjust the path to your sound file
        audio.play();
    </script>
@endif

@if (session('error'))
    <script>
        Swal.fire({
            title: 'Failure!',
            text: '{{ session('error') }}',
            icon: 'error',
            confirmButtonText: 'OK'
        });

        var audio = new Audio('{{ asset('public/sweet-alert/error.mp3') }}'); // Adjust the path to your sound file
        audio.play();
    </script>
@endif

<script src="{{ asset('public/admin/app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
<script src="{{ asset('public/admin/app-assets/js/scripts/forms/form-select2.js')}}"></script>

@stack('scripts')
