
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
                            <h2 class="content-header-title float-start mb-0">Loan Application Approval</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{ route('enquires.index') }}">Loan Application Approval</a>
                                    </li>
                                    <li class="breadcrumb-item active">List
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3" style="text-align: end;">
                    {{-- <a href="{{route('applications.create')}}" class=" btn btn-primary btn-gradient round  ">Add Enquiry</a> --}}
                </div>
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
                                                <th>Application ID</th>
                                                <th>Customer Name</th>
                                                <th>Mobile</th>
                                                <th>Loan Type</th>
                                                <th>PRINICIPAL AMT.</th>
                                                <th>Created Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php  $i=1; @endphp
                                            @foreach($applications as $key => $val)
                                            <tr>
                                                <th scope="row">{{ $i }}</th>
                                                <th><a href="#">{{ $val->application_id }}</a></th>
                                                <td><strong>{{ $val->customer->first_name }} {{ $val->customer->last_name }}</strong></td>
                                                <td>{{ $val->customer->mobile }}</td>
                                                <td>{{ $val->loan_type }}</td>
                                                <td>{{ $val->loan_amount }}</td>
                                                <td>{{ date('d-M-y H:i:s',strtotime($val->created_at)) }}</td>
                                                <td><button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#accept_{{ $val->id }}" >Accept</button>
                                                    <div class="modal fade modal text-start" id="accept_{{ $val->id }}" tabindex="-1" aria-labelledby="myModalLabel120" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="myModalLabel120">Approval For Disbursement</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <form action="{{ route('application_form.approved') }}" method="POST">
                                                                        @csrf
                                                                        <input type="hidden" name="id" value="{{ $val->id }}">
                                                                        <div class="modal-body">
                                                                            <div class="row">
                                                                                <div class="col-md-12 mb-1">
                                                                                    <label for="">Requested Amount*</label>
                                                                                    <input type="text" readonly class="form-control" value="{{ $val->loan_amount }}">
                                                                                </div>
                                                                                <div class="col-md-12 mb-1">
                                                                                    <label for="">Approved Amount*</label>
                                                                                    <input type="number"  class="form-control" name="loan_amount" value="{{ $val->loan_amount }}" max="{{ $val->loan_amount }}">
                                                                                </div>
                                                                                <div class="col-md-12 mb-1">
                                                                                    <label for="">Emi Start From*</label>
                                                                                    <input type="date"  class="form-control" name="start_date" value="{{ date('Y-m-d') }}" max="">
                                                                                </div>
                                                                            </div>    
                                                                        </div>
                                                                        
                                                                        <div class="modal-footer">
                                                                            <button type="submit" class="btn btn-success" >Submit</button>
                                                                        </div>
                                                                    </form>
                                                                    
                                                                </div>
                                                        </div>
                                                    </div>
                                                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#reject_{{ $val->id }}">Reject</button>
                                                    <div class="modal fade modal text-start" id="reject_{{ $val->id }}" tabindex="-1" aria-labelledby="myModalLabel120" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="myModalLabel120">Approval For Rejection</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <form action="{{ route('application_form.reject') }}" method="POST">
                                                                        @csrf
                                                                        <input type="hidden" name="id" value="{{ $val->id }}">
                                                                        <div class="modal-body">
                                                                            <div class="row">
                                                                                <div class="col-md-12 mb-1">
                                                                                    <textarea name="reason" id="" cols="3" rows="3" class="form-control" placeholder="Add your rejection reason here....">{{ $val->comment }}</textarea>
                                                                                </div>
                                                                            </div>    
                                                                        </div>
                                                                        
                                                                        <div class="modal-footer">
                                                                            <button type="submit" class="btn btn-danger" >Submit</button>
                                                                        </div>
                                                                    </form>
                                                                    
                                                                </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @php $i++; @endphp
                                            @endforeach


                                        </tbody>
                                    </table>

                                </div>

                                {{-- @include('_pagination', ['data' => $applications]) --}}

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