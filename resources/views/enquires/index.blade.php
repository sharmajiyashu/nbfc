
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
                            <h2 class="content-header-title float-start mb-0">Customer Enquiry</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{ route('enquires.index') }}">Enquires</a>
                                    </li>
                                    <li class="breadcrumb-item active">List
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3" style="text-align: end;">
                    <a href="{{route('enquires.create')}}" class=" btn btn-primary btn-gradient round  ">Add Enquiry</a>
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
                                                <th>Enquiry <br> ID</th>
                                                <th>Customer Name</th>
                                                <th>Mobile</th>
                                                <th>City</th>
                                                <th>Pin Code</th>
                                                <th>Comment</th>
                                                <th>Login Charge</th>
                                                {{-- <th>Status</th> --}}
                                                <th>Update Status</th>
                                                <th>Member Application Form</th>
                                                <th>Created Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php  $i=1; @endphp
                                            @foreach($enquires as $key => $val)
                                            <tr>
                                                <th scope="row">{{ $i }}</th>
                                                <th><a href="#">{{ $val->enquiry_id }}</a></th>
                                                <td><strong>{{ $val->first_name }} {{ $val->last_name }}</strong></td>
                                                <td>{{ $val->mobile }}</td>
                                                <td>{{ $val->city }}</td>
                                                <td>{{ $val->pin_code }}</td>
                                                <td>{{ $val->comment }}</td>
                                                <td>{{ $val->login_charge }}</td>
                                                
                                                <td style="text-transform: uppercase;">{{ $val->status }} 

                                                    <br>
                                                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#danger_ke{{ $val->id }}">Update</button>

                                                    <div class="modal fade modal text-start" id="danger_ke{{ $val->id }}" tabindex="-1" aria-labelledby="myModalLabel120" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="myModalLabel120">Update Status</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <form action="{{ route('enquiries.change_status') }}" method="POST">
                                                                        @csrf
                                                                        <input type="hidden" name="id" value="{{ $val->id }}">
                                                                        <div class="modal-body">
                                                                            <div class="row">
                                                                                <div class="col-md-12 mb-1">
                                                                                    <label for="">Status</label>
                                                                                    <select class="select2 form-select" name="status" id="status"  required style="text-transform: uppercase;" >
                                                                                        <option value="">Select Marital Status</option>
                                                                                        @foreach (config('constant.enquiries_status') as $key => $value)
                                                                                            <option value="{{ $key }}" {{ (isset($val->status) && $val->status == $value) ? 'selected' : '' }}>{{ $value }}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                                <div class="col-md-12 mb-1">
                                                                                    <textarea name="comment" id="" cols="3" rows="3" class="form-control" placeholder="Add your comment here....">{{ $val->comment }}</textarea>
                                                                                </div>
                                                                            </div>    
                                                                        </div>
                                                                        
                                                                        <div class="modal-footer">
                                                                            <button type="submit" class="btn btn-success" >Update</button>
                                                                        </div>
                                                                    </form>
                                                                    
                                                                </div>
                                                        </div>
                                                    </div>


                                                </td>
                                                
                                                <td>
                                                    <a href="{{ route('application-form',$val->enquiry_id) }}"><button class="btn btn-warning">Form</button></a>
                                                </td>
                                                <td>{{ date('d-M-y H:i:s',strtotime($val->created_at)) }}</td>
                                                <td>
                                                    <a  href="{{route('enquires.edit',$val->id)}}">
                                                        <i class="fa fa-pencil text-primary"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            @php $i++; @endphp
                                            @endforeach


                                        </tbody>
                                    </table>

                                </div>

                                @include('_pagination', ['data' => $enquires])

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