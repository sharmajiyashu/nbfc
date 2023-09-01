
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
                                    <table class="datatables-ajax table table-responsive datatable_data">

                                        
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
                                                <th>Member Application</th>
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
                                                
                                                <td style="text-transform: capitalize;">{{ $val->status }} 

                                                    <br>
                                                    <button class="btn btn-success">Update</button>
                                                </td>
                                                
                                                <td>
                                                    <a href="{{ route('application-form',$val->enquiry_id) }}"><button class="btn btn-warning">Fill Application Form</button></a>
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