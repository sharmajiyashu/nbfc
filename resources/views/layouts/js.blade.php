<!-- BEGIN: Vendor JS-->
<script src="{{ asset('public/admin/app-assets/vendors/js/vendors.min.js')}}"></script>
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
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
{{-- <script src="{{ asset('public/admin/app-assets/js/core/app-menu.js')}}"></script> --}}
{{-- <script src="{{ asset('public/admin/app-assets/js/core/app.js')}}"></script> --}}
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




<script src="{{ asset('public/admin/assets/datatable/dataTables.min.js') }}"></script>



<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>

<script>
    $(document).ready(function() {
        $('.datatable_data').DataTable( {

        });
        
        // $('.datatable_data_2').DataTable( {
        //     "pageLength": 50,
        //     "aaSorting": []
        //     // "ordering": false
        //     // "aaSorting": []
        // });

});

$(document).ready( function() {
    $('.datatable_data_2').DataTable( {
        // dom: 'Bfrtip',
        // buttons: [
            //  'csv', 'excel',
        // ],
        "pageLength": 100,
        "aaSorting": [],
        "ordering": false,
        "aaSorting": [],
    } );
} );


</script>

<script>
    $(document).ready(function() {
        
        toastr.options.timeOut = 10000;
        @if (Session::has('error'))
            toastr.error('{{ Session::get('error') }}');
            
        @elseif(Session::has('success'))
            toastr.success('{{ Session::get('success') }}');
        @endif

    });
</script>

<script src="{{ asset('public/admin/app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
<script src="{{ asset('public/admin/app-assets/js/scripts/forms/form-select2.js')}}"></script>

@stack('scripts')



<script>
    $(document).ready(function() {
        // $("#family_details").hide();
        $("input[name='marital_status']").change(function () {
            if ($(this).val() == "married") {
            $("#family_details").show();
            } else {
            $("#family_details").hide();
            }
        });

        const radioBtn = document.getElementById('marital_status_checked_married_option');
        if (radioBtn.checked) {
            // Display the radio button value
            $("#family_details").show();
        }


    });


</script>
