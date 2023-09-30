
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
                    <div class="row breadcrumbs-top">
                        <div class="col-12" style="text-align: center">
                            <h2 class="content-header-title">Profit & Loss Statement</h2>
                            {{-- <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{ route('emi_collect') }}">Collect EMI</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{ route('emis.show',$loan->id) }}">Loan ID : {{ $loan->loan_id }}</a>
                                    </li>
                                    <li class="breadcrumb-item active">Journal Entries
                                    </li>
                                </ol>
                            </div> --}}
                        </div>
                    </div>
                </div>
                {{-- <div class="col-md-3" style="text-align: end;">
                    <a href="{{route('enquires.create')}}" class=" btn btn-primary btn-gradient round  ">Add Enquiry</a>
                </div> --}}
            </div>
            <div class="content-body">
                <!-- Ajax Sourced Server-side -->
                <section id="ajax-datatable" style="">
                    <div class="row" style="justify-content: center;" >
                        <div class="col-md-10">
                            <div class="card">
                                
                                <div class="card-datatable">
                                    <table class="datatables-ajax table table-responsive">
                                        <thead>
                                            <tr>
                                                <th style="width: 40%;">Expenses</th>
                                                <th style="width: 10%;">Amount</th>
                                                <th style="width: 40%;">Income</th>
                                                <th style="width: 10%;">Amount</th>

                                            </tr>
                                            
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th>Bank Charge</th>
                                                <th>0</th>
                                                <th>Processing Fees</th>
                                                <th>{{ $data['processing_fees'] }}</th>

                                            </tr>
                                            <tr>
                                                <th>Advertising</th>
                                                <th>0</th>
                                                <th>Log in Charge</th>
                                                <th>{{ $data['login_charge'] }}</th>
                                            </tr>
                                            <tr>
                                                <th>Accounting</th>
                                                <th>0</th>
                                                <th>Additional Charge</th>
                                                <th>0</th>
                                            </tr>
                                            <tr>
                                                <th>-</th>
                                                <th>-</th>
                                                <th>EMI Interest Account</th>
                                                <th>{{ $data['emi_interest'] }}</th>
                                            </tr>
                                            <tr>
                                                <th>-</th>
                                                <th>-</th>
                                                <th>Penalty Charge</th>
                                                <th>0</th>
                                            </tr>
                                            <tr>
                                                <th>-</th>
                                                <th>-</th>
                                                <th>Other Income</th>
                                                <th>0</th>
                                            </tr>
                                            <tr>
                                                <th>-</th>
                                                <th>-</th>
                                                <th>-</th>
                                                <th>-</th>
                                            </tr>
                                            <tr>
                                                <th>Profit/Loss</th>
                                                <th>{{ $data['total'] }}</th>
                                                <th>-</th>
                                                <th>-</th>
                                            </tr>
                                            <tr style="background-color:#f5dfb7">
                                                <th>Total</th>
                                                <th>{{ $data['total'] }}</th>
                                                <th>Total</th>
                                                <th>{{ $data['total'] }}</th>
                                            </tr>
                                            
                                        </tbody>
                                    </table>

                                </div>

                                {{-- @include('_pagination', ['data' => $journal_entries]) --}}

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