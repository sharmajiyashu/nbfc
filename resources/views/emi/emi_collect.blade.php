
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
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0"> Collect EMI</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="">Collect EMI</a>
                                    </li>
                                    <li class="breadcrumb-item active">List
                                    </li>
                                </ol>
                            </div>
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
                                                <th>Loan <br> ID</th>
                                                <th>Customer <br> Name</th>
                                                <th>Mobile</th>
                                                <th>Loan <br>Type</th>
                                                {{-- <th>Amount <br> Requested</th> --}}
                                                <th>Principle</th>
                                                <th>Emi</th>
                                                <th>Interest <br> Rate</th>
                                                <th>Tenure</th>
                                                {{-- <th>Interest <br> Amount</th> --}}
                                                {{-- <th>Total Paid <br> Amount</th> --}}
                                                <th>Approved <br>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php  $i=1; @endphp
                                            @foreach($loan_application as $key => $val)
                                            <tr>
                                                <th scope="row">{{ $i }}</th>
                                                <th><a href="{{ route('emis.show',$val->id) }}">{{ $val->loan_id }}</a></th>
                                                <td><strong>{{ $val->first_name }} {{ $val->last_name }}</strong></td>
                                                <td>{{ $val->mobile }}</td>
                                                <td>{{ $val->loan_type }}</td>
                                                {{-- <td>{{ $val->amount_requested }}</td> --}}
                                                {{-- <td><strong>{{ $val->loan_amount }}</strong></td> --}}
                                                <td><strong>{{ number_format($val->loan_amount, 0, '.', ',') }}</strong></td>
                                                <td class="text-success"><strong>{{ $val->emi }}</strong></td>
                                                <td>{{ $val->rate_of_interest }}%</td>
                                                <td>{{ $val->tenure }}</td>
                                                {{-- <td>{{ $val->interest_amount }}</td> --}}
                                                {{-- <td><strong>{{ number_format($val->total_amount_paid, 0, '.', ',') }}</strong></td> --}}
                                                <td>{{ date('d-M-y H:i:s',strtotime($val->created_at)) }}</td>
                                            </tr>
                                            @php $i++; @endphp
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>

                                @include('_pagination', ['data' => $loan_application])

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