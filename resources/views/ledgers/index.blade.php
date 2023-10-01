
@extends('layouts.app')

@section('content')

<style>
    .Active{
        color: green;
        font-weight: 900;
    }
    .Inactive{
        color: red;
        font-weight: 900;
    }
</style>

 <!-- BEGIN: Content-->
<!-- BEGIN: Content-->
<div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-12 col-12 mb-2">
                    <div class="row breadcrumbs-top" >
                        <div class="col-12" style="text-align: center">
                            <h1 class="content-header-title ">Ledgers</h1>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-md-3" style="text-align: end;">
                    <a href="{{route('enquires.create')}}" class=" btn btn-primary btn-gradient round  ">Add Enquiry</a>
                </div> --}}
            </div>
            <div class="content-body">
                <!-- Ajax Sourced Server-side -->
                <section id="ajax-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                
                                <div class="card-datatable">
                                    <table class="datatables-ajax table table-responsive">
                                        <thead>
                                            <tr>
                                                <th>Sr.no</th>
                                                <th>Name</th>
                                                <th>Total Credit Amount</th>
                                                <th>Total Debit Amount</th>
                                                <th>Update Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php  $i=1; @endphp
                                            @foreach($ledgers as $key => $val)
                                            <tr>
                                                <th scope="row">{{ $i }}</th>
                                                <th><a href="{{ route('ledgers.show',$val->id) }}">{{ $val->name }}</a></th>
                                                <th>{{ $val->total_cr }}</th>
                                                <th>{{ $val->total_dr }}</th>
                                                <td>{{ date('d-M-y H:i:s',strtotime($val->created_at)) }}</td>
                                            </tr>
                                            @php $i++; @endphp
                                            @endforeach


                                        </tbody>
                                    </table>

                                </div>

                                @include('_pagination', ['data' => $ledgers])

                            </div>
                        </div>
                    </div>
                </section>

                <!--/ Ajax Sourced Server-side -->

                

            </div>
        </div>
    </div>
    <!-- END: Content-->
    <!-- END: Content-->

@endsection