


@extends('layouts.app')

@section('content')

<style>
    .error{
        color:red;
    }
    /* input {
        text-transform: uppercase;
    } */

    .head{
        background-color: #d73925c4;
        color: white;
    }
</style>

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
                                    <li class="breadcrumb-item"><a href="{{  route('dashboard') }}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{ route('enquires.index') }}">Enquires</a>
                                    </li>
                                    <li class="breadcrumb-item active">Add
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">

            @if ($errors->any())
                @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <div class="alert-body">
                                            {{$error}}
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endforeach
            @endif

                 <!-- Horizontal Wizard -->
                 <section class="horizontal-wizard">
                    <div class="bs-stepper horizontal-wizard-example">
                        <div class="bs-stepper-header" role="tablist">
                            <div class="step active" data-target="#account-details" role="tab" id="account-details-trigger">
                                <button type="button" class="step-trigger">
                                    <span class="bs-stepper-box">1</span>
                                    <span class="bs-stepper-label">
                                        <span class="bs-stepper-title">Customer Details</span>
                                        <span class="bs-stepper-subtitle">Setup Account Details</span>
                                    </span>
                                </button>
                            </div>
                            <div class="line">
                                <i data-feather="chevron-right" class="font-medium-2"></i>
                            </div>
                            <div class="step " data-target="#personal-info" role="tab" id="personal-info-trigger">
                                <button type="button" class="step-trigger">
                                    <span class="bs-stepper-box">2</span>
                                    <span class="bs-stepper-label">
                                        <span class="bs-stepper-title">Nominee Info</span>
                                        <span class="bs-stepper-subtitle">Add Nominee Info</span>
                                    </span>
                                </button>
                            </div>
                            <div class="line">
                                <i data-feather="chevron-right" class="font-medium-2"></i>
                            </div>
                            <div class="step" data-target="#address-step" role="tab" id="address-step-trigger">
                                <button type="button" class="step-trigger">
                                    <span class="bs-stepper-box">3</span>
                                    <span class="bs-stepper-label">
                                        <span class="bs-stepper-title">Guarnter Details</span>
                                        <span class="bs-stepper-subtitle">Add Guarnter Info</span>
                                    </span>
                                </button>
                            </div>
                            
                        </div>
                        <div class="bs-stepper-content">
                            <div >
                                {{-- <div class="content-header">
                                    <h5 class="mb-0">Customer Details</h5>
                                    <small class="text-muted">Enter Your Account Details.</small>
                                </div> --}}
                                <form method="POST" action="{{ route('application.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="enquiry_id" value="{{ $enquiry->id }}">
                                    <div class="row">
                                        <div class="mb-1 col-md-6">
                                            <label class="form-label" for="username">Enrollment Date *</label>
                                            @php 
                                                if(isset($application_form->enrollment_date)){
                                                    $enrollment_date = $application_form->enrollment_date;
                                                }elseif (!empty(old('enrollment_date'))) {
                                                    $enrollment_date = old('enrollment_date');
                                                }else {
                                                    $enrollment_date = date('Y-m-d');
                                                }
                                            @endphp
                                            <input type="date" name="enrollment_date"  class="form-control"  value="{{ $enrollment_date }}"/>
                                        </div>

                                        <div class="border-top mb-1"></div>

                                        <div class="text-center">
                                            <h2 class="head">Customer's Info</h2>
                                        </div>

                                        <div class="col-md-6 mb-1">
                                            <label class="form-label" for="customer_image">Profile Photo <span class="error">*</span> </label>
                                            <input type="file" id="customer_image" name="customer_image"  class="form-control"  value=""/>
                                        </div>

                                        <div class="col-md-6"></div>

                                        <div class="col-md-6 mb-1">
                                            <div class="form-group">
                                                <label class="form-label" for="first-name-column">Title <span class="error">*</span></label>
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <input type="radio"  name="customer_title" value="Md" {{ (!empty($customer->title) && $customer->title == 'Md') ? 'checked' : '' }} > <span>Md.</span>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <input type="radio" @empty($customer->title) @checked(true) @endempty name="customer_title" value="Mr" {{ (!empty($customer->title) && $customer->title == 'Mr') ? 'checked' : '' }} > <span>Mr.</span>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <input type="radio"  name="customer_title" value="Ms" {{ (!empty($customer->title) && $customer->title == 'Ms') ? 'checked' : '' }}> <span>Ms.</span>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <input type="radio"  name="customer_title" value="Mrs"  {{ (!empty($customer->title) && $customer->title == 'Mrs') ? 'checked' : '' }}> <span>Mrs.</span>
                                                    </div>                                                        
                                                </div> 
                                            </div> 
                                        </div>

                                        <div class="col-md-6 mb-1">
                                            <div class="form-group">
                                                <label class="form-label" for="first-name-column">Gender <span class="error">*</span></label>
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <input type="radio" checked  name="customer_gender" value="Male" {{ (!empty($customer->gender) && $customer->gender == 'Male') ? 'checked' : '' }}> <span>Male</span>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <input type="radio"  name="customer_gender" value="Female"  {{ (!empty($customer->gender) && $customer->gender == 'Female') ? 'checked' : '' }}> <span>Female</span> 
                                                    </div>
                                                    <div class="col-md-2">
                                                        <input type="radio"  name="customer_gender" value="Other" {{ (!empty($customer->gender) && $customer->gender == 'Other') ? 'checked' : '' }}> <span>Other</span>
                                                    </div>
                                                </div> 
                                            </div> 
                                        </div>

                                        <div class="col-md-6 mb-1">
                                            <label class="form-label" for="username">First Name <span class="error">*</span></label>
                                            <input type="text" name="first_name" required class="form-control" placeholder="First Name" value="@if(isset($customer->first_name)){{$customer->first_name}}@else{{ old('first_name')}}@endif"/>
                                        </div>

                                        <div class="col-md-6 mb-1">
                                            <label class="form-label" for="username">Last Name <span class="error">*</span></label>
                                            <input type="text" name="last_name" required  class="form-control" placeholder="Last Name" value="@if(isset($customer->last_name)){{$customer->last_name}}@else{{ old('last_name')}}@endif"/>
                                        </div>

                                        <div class="col-md-6 mb-1">
                                            <label class="form-label" for="username">Mobile <span class="error">*</span></label>
                                            <input type="number" name="mobile" required  class="form-control" placeholder="Mobile" value="@if(isset($customer->mobile)){{$customer->mobile}}@else{{ old('first_name')}}@endif"/>
                                        </div>

                                        <div class="col-md-6 mb-1">
                                            <label class="form-label" for="username">Dob </label>
                                            <input type="date" name="dob"  class="form-control" placeholder="DOB" value="@if(isset($customer->dob)){{$customer->dob}}@else{{ old('dob')}}@endif"/>
                                        </div>

                                        <div class="col-md-6 mb-1">
                                            <label class="form-label" for="username">Qualification  </label>
                                            <input type="text" name="qualification"  class="form-control" placeholder="Qualification" value="@if(isset($customer->qualification)){{$customer->qualification}}@else{{ old('qualification')}}@endif"/>
                                        </div>

                                        <div class="col-md-6 mb-1">
                                            <label class="form-label" for="username">Occupation </label>
                                            <input type="text" name="occupation"  class="form-control" placeholder="Occupation" value="@if(isset($customer->occupation)){{$customer->occupation}}@else{{ old('occupation')}}@endif"/>
                                        </div>

                                        <div class="col-md-6 mb-1">
                                            <label class="form-label" for="username">Old Customer No (if any) </label>
                                            <input type="number" name="old_customer_mobile"  class="form-control" placeholder="Old Customer Number" value="@if(isset($customer->reference_mobile)){{$customer->reference_mobile}}@else{{ old('old_customer_mobile')}}@endif"/>
                                        </div>

                                        <div class="col-md-6 mb-1">
                                            <label class="form-label" for="username">Father Name </label>
                                            <input type="text" name="father_name"  class="form-control" placeholder="Father Name" value="@if(isset($customer->father_name)){{$customer->father_name}}@else{{ old('father_name')}}@endif"/>
                                        </div>

                                        <div class="col-md-6 mb-1">
                                            <label class="form-label" for="username">Mother Name </label>
                                            <input type="text" name="mother_name"  class="form-control" placeholder="Mother Name" value="@if(isset($customer->mother_name)){{$customer->mother_name}}@else{{ old('mother_name')}}@endif"/>
                                        </div>

                                        <div class="col-md-6 mb-1">
                                            <label class="form-label" for="username">Husband/ Wife Name</label>
                                            <input type="text" name="spouse_name"  class="form-control" placeholder="Husband/ Wife Name" value="@if(isset($customer->spouse_name)){{$customer->spouse_name}}@else{{ old('spouse_name')}}@endif"/>
                                        </div>

                                        <div class="col-md-6 mb-1">
                                            <label class="form-label" for="username">Alternative Mobile No</label>
                                            <input type="text" name="alternative_mobile"  class="form-control" placeholder="Alternative Mobile No" value="@if(isset($customer->alternative_mobile)){{$customer->alternative_mobile}}@else{{ old('alternative_mobile')}}@endif"/>
                                        </div>

                                        <div class="col-md-6 mb-1">
                                            <label class="form-label" for="username">Marital Status</label>
                                            <select class="select2 form-select" name="marital_status" id="marital_status"  required >
                                                <option value="">Select Marital Status</option>
                                                @foreach (config('constant.marital_status') as $key => $value)
                                                    <option value="{{ $key }}" {{ (isset($customer->marital_status) && $customer->marital_status == $key) ? 'selected' : '' }}>{{ $value }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-6 mb-1">
                                            <label class="form-label" for="username">Email</label>
                                            <input type="email" name="email"  class="form-control" placeholder="Email" value="@if(isset($customer->email)){{$customer->email}}@else{{ old('email')}}@endif"/>
                                        </div>

                                        <div class="border-top mb-1"></div>
                                        <div class="text-center">
                                            <h2 class="head" >Processing Fee</h2>
                                        </div>

                                        <div class="col-md-6 mb-1">
                                            <label class="form-label" for="username">Processing Fee</label>
                                            <input type="number" required name="processing_fees"  class="form-control" placeholder="Processing Fee" value="@if(isset($application_form->processing_fees)){{$application_form->processing_fees}}@else{{ old('processing_fees')}}@endif"/>
                                        </div>

                                        <div class="col-md-6 mb-1">

                                            @php
                                                if(!empty($application->payment_mode)){
                                                    $payment_mode = $application->payment_mode;
                                                }elseif (!empty(old('payment_mode'))) {
                                                    $payment_mode = old('payment_mode');
                                                }else {
                                                    $payment_mode = 'cash';
                                                }
                                            @endphp

                                            <div class="form-group">
                                                <label class="form-label" for="first-name-column">Pay Mode<span class="error">*</span></label>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <input type="radio" id="" name="payment_mode" value="cash" {{ ($payment_mode == 'cash' ? "checked":"") }} > <span>Cash</span>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input type="radio" id="single" name="payment_mode" value="cheque" {{ ($payment_mode == 'cheque' ? "checked":"") }} > <span>Cheque</span> 
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input type="radio" id="widowed" name="payment_mode" value="online" {{ ($payment_mode == 'online' ? "checked":"") }} > <span>Online Tr.
                                                        </span>
                                                    </div>
                                                </div> 
                                            </div> 
                                        </div>

                                        <div class="border-top mb-1"></div>
                                        <div class="text-center">
                                            <h2 class="head" >Correspondence Address</h2>
                                        </div>

                                        <div class="col-md-6 mb-1">
                                            <label class="form-label" for="username">Address Line 1</label>
                                            <textarea name="postal_address_1" required class="form-control" id="" cols="2" rows="2" placeholder="Address Line 1">@if(isset($postal_address->address)){{$postal_address->address}}@else{{ $enquiry->address }}@endif</textarea>
                                        </div>

                                        <div class="col-md-6 mb-1">
                                            <label class="form-label" for="username">Address Line 2</label>
                                            <textarea name="postal_address_2" required class="form-control" id="" cols="2" rows="2" placeholder="Address Line 2">@if(isset($postal_address->address)){{$postal_address->address}}@else{{ $enquiry->address_2 }}@endif</textarea>
                                        </div>

                                        <div class="col-md-6 mb-1">
                                            <label class="form-label" for="username">Area </label>
                                            <input type="text" name="postal_area"  required class="form-control" placeholder="Area" value=""/>
                                        </div>

                                        <div class="col-md-6 mb-1">
                                            <label class="form-label" for="username">Landmark </label>
                                            <input type="text" name="postal_land_mark" required  class="form-control" placeholder="Land Mark" value=""/>
                                        </div>

                                        <div class="col-md-6 mb-1">
                                            <label class="form-label" for="username">City </label>
                                            <input type="text" name="postal_city" required  class="form-control" placeholder="City" value=""/>
                                        </div>

                                        <div class="col-md-6 mb-1">
                                            <label class="form-label" for="username">District </label>
                                            <input type="text" name="postal_district" required  class="form-control" placeholder="District" value=""/>
                                        </div>

                                        <div class="col-md-6 mb-1">
                                            <label class="form-label" for="username">State </label>
                                            <select class="select2 form-select" required name="postal_state" id="postal_state"  >
                                                <option value="">Select State</option>
                                                @foreach (config('constant.states') as $key => $value)
                                                    <option value="{{ $value }}">{{ $value }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-3 mb-1">
                                            <label class="form-label" for="username">Pin Code </label>
                                            <input type="number" name="postal_pin" required class="form-control" placeholder="Pin Code" value=""/>
                                        </div>

                                        <div class="col-md-3 mb-1">
                                            <label class="form-label" for="username">Country </label>
                                            <input type="text" name="postal_country" required  class="form-control" placeholder="Countary" readonly value="INDIA"/>
                                        </div>

                                        <div class="border-top mb-1"></div>
                                        <div class="text-center">
                                            <h2 class="head"> Permanent Address </h2>
                                        </div>

                                        <div class="col-md-6 mb-1">
                                            <label class="form-label" for="username">Address Line 1</label>
                                            <textarea name="permanant_address_1" class="form-control" id="" cols="2" rows="2" placeholder="Address Line 1"></textarea>
                                        </div>

                                        <div class="col-md-6 mb-1">
                                            <label class="form-label" for="username">Address Line 2</label>
                                            <textarea name="permanant_address_2" class="form-control" id="" cols="2" rows="2" placeholder="Address Line 2"></textarea>
                                        </div>

                                        <div class="col-md-6 mb-1">
                                            <label class="form-label" for="username">Area </label>
                                            <input type="text" name="permanant_area"  class="form-control" placeholder="Area" value=""/>
                                        </div>

                                        <div class="col-md-6 mb-1">
                                            <label class="form-label" for="username">Landmark </label>
                                            <input type="text" name="permanant_land_mark"  class="form-control" placeholder="Land Mark" value=""/>
                                        </div>

                                        <div class="col-md-6 mb-1">
                                            <label class="form-label" for="username">City </label>
                                            <input type="text" name="permanant_city"  class="form-control" placeholder="City" value=""/>
                                        </div>

                                        <div class="col-md-6 mb-1">
                                            <label class="form-label" for="username">District </label>
                                            <input type="text" name="permanant_district"  class="form-control" placeholder="District" value=""/>
                                        </div>

                                        <div class="col-md-6 mb-1">
                                            <label class="form-label" for="username">State </label>
                                            <select class="select2 form-select" name="permanant_state" id="permanant_state"  >
                                                <option value="">Select State</option>
                                                @foreach (config('constant.states') as $key => $value)
                                                    <option value="{{ $value }}">{{ $value }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-3 mb-1">
                                            <label class="form-label" for="username">Pin Code </label>
                                            <input type="number" name="permanant_pin"  class="form-control" placeholder="Pin Code" value=""/>
                                        </div>

                                        <div class="col-md-3 mb-1">
                                            <label class="form-label" for="username">Country </label>
                                            <input type="text" name="permanant_country"  class="form-control" placeholder="Countary" readonly value="INDIA"/>
                                        </div>

                                        <div class="border-top mb-1"></div>
                                        <div class="text-center">
                                            <h2 class="head">Customer KYC </h2>
                                        </div>

                                        <div class="col-md-3 mb-1">
                                            <label class="form-label" for="username">Aadhar Number </label>
                                            <input type="text" name="aadhar_number"  class="form-control" placeholder="Aadhar Number" value="{{ old('aadhar_number') }}"/>
                                        </div>

                                        <div class="col-md-3 mb-1">
                                            <label class="form-label" for="username">Aadhaar Doc </label>
                                            <input type="file" name="aadhar_doc"  class="form-control"  value=""/>
                                        </div>

                                        <div class="col-md-3 mb-1">
                                            <label class="form-label" for="username">Voter ID No </label>
                                            <input type="text" name="voter_id"  class="form-control" placeholder="Voter ID Number" value="{{ old('voter_id') }}"/>
                                        </div>

                                        <div class="col-md-3 mb-1">
                                            <label class="form-label" for="username">Voter ID Doc </label>
                                            <input type="file" name="voter_doc"  class="form-control" placeholder="" value=""/>
                                        </div>

                                        <div class="col-md-3 mb-1">
                                            <label class="form-label" for="username">Pan No. </label>
                                            <input type="text" name="pan_number"  class="form-control" placeholder="Pan Number" value="{{ old('pan_number') }}"/>
                                        </div>

                                        <div class="col-md-3 mb-1">
                                            <label class="form-label" for="username">Pan Doc </label>
                                            <input type="file" name="pan_doc"  class="form-control" placeholder="" value=""/>
                                        </div>

                                        <div class="col-md-3 mb-1">
                                            <label class="form-label" for="username">Ration Card No.</label>
                                            <input type="text" name="ration_card_number"  class="form-control" placeholder="Ration Card Number" value="{{ old('ration_card_number') }}"/>
                                        </div>

                                        <div class="col-md-3 mb-1">
                                            <label class="form-label" for="username">Ration Card Doc </label>
                                            <input type="file" name="ration_card_doc"  class="form-control" placeholder="johndoe" value=""/>
                                        </div>

                                        <div class="col-md-3 mb-1">
                                            <label class="form-label" for="username">DL No.</label>
                                            <input type="text" name="dl_number"  class="form-control" placeholder="DL Number" value="{{ old('dl_number') }}"/>
                                        </div>

                                        <div class="col-md-3 mb-1">
                                            <label class="form-label" for="username">DL Doc </label>
                                            <input type="file" name="dl_doc"  class="form-control" placeholder="" value=""/>
                                        </div>

                                        <div class="col-md-3 mb-1">
                                            <label class="form-label" for="username">Bank Statement. </label>
                                            <input type="text" name="bank_statement_number"  class="form-control" placeholder="Bank Statement" value="{{ old('bank_statement_number') }}"/>
                                        </div>

                                        <div class="col-md-3 mb-1">
                                            <label class="form-label" for="username">Bank Statement Doc </label>
                                            <input type="file" name="bank_statement_doc"  class="form-control" placeholder="" value=""/>
                                        </div>

                                        <div class="col-md-3 mb-1">
                                            <label class="form-label" for="username">Cibil Score. </label>
                                            <input type="text" name="cibil_score_name"  class="form-control" placeholder="Cibil Score" value="{{ old('cibil_score_name') }}"/>
                                        </div>

                                        <div class="col-md-3 mb-1">
                                            <label class="form-label" for="username">Cibil Score Doc </label>
                                            <input type="file" name="cibil_score_doc"  class="form-control" placeholder="" value=""/>
                                        </div>

                                        <div class="col-md-3 mb-1">
                                            <label class="form-label" for="username">Cheque . </label>
                                            <input type="text" name="cheque_number"  class="form-control" placeholder="Cheque" value="{{ old('cheque_number') }}"/>
                                        </div>

                                        <div class="col-md-3 mb-1">
                                            <label class="form-label" for="username">Cheque  Doc </label>
                                            <input type="file" name="usernamklhgjke"  class="form-control" placeholder="" value=""/>
                                        </div>

                                        <div class="col-md-3 mb-1">
                                            <label class="form-label" for="username">Property Papers </label>
                                            <input type="text" name="property_paper_number"  class="form-control" placeholder="Property Papers" value="{{ old('property_paper_number') }}"/>
                                        </div>

                                        <div class="col-md-3 mb-1">
                                            <label class="form-label" for="username">Property Papers  Doc </label>
                                            <input type="file" name="usernamklhgjke"  class="form-control" placeholder="johndoe" value=""/>
                                        </div>

                                        <div class="col-md-3 mb-1">
                                            <label class="form-label" for="username">Other Document. </label>
                                            <input type="text" name="other_document_name"  class="form-control" placeholder="Other Document" value="{{ old('other_document_name') }}"/>
                                        </div>

                                        <div class="col-md-3 mb-1">
                                            <label class="form-label" for="username">Other Document Doc </label>
                                            <input type="file" name="other_document_doc"  class="form-control" placeholder="johndoe" value=""/>
                                        </div>

                                        <div class="border-top mb-1"></div>
                                        <div class="text-center">
                                            <h2 class="head">Income and Banking Details </h2>
                                        </div>

                                        <div class="col-md-6 mb-1">
                                            <label class="form-label" for="username">Annual Salary  </label>
                                            <input type="text" name="annual_salary"  class="form-control" placeholder="Annual Salary" value=""/>
                                        </div>

                                        <div class="col-md-6 mb-1">
                                            <label class="form-label" for="username">Other Income </label>
                                            <input type="text" name="other_income"  class="form-control" placeholder="Other Income" value=""/>
                                        </div>

                                        <div class="col-md-6 mb-1">
                                            <label class="form-label" for="username">Name Of Bank  </label>
                                            <input type="text" name="bank_name"  class="form-control" placeholder="Bank Name" value=""/>
                                        </div>

                                        <div class="col-md-3 mb-1">
                                            <label class="form-label" for="username">Bank Branch </label>
                                            <input type="text" name="bank_branch"  class="form-control" placeholder="Bank Branch" value=""/>
                                        </div>

                                        <div class="col-md-3 mb-1">
                                            <label class="form-label" for="username">Type Of Account  </label>
                                            <input type="text" name="type_of_account"  class="form-control" placeholder="type of Account" value=""/>
                                        </div>

                                        <div class="border-top mb-1"></div>
                                        <div class="text-center">
                                            <h2 class="head">Credit Card Details </h2>
                                        </div>

                                        <div class="col-md-6 mb-1">
                                            <label class="form-label" for="username">Issuer  </label>
                                            <input type="text" name="card_issuer"  class="form-control" placeholder="Issuer" value="{{ old('card_issuer') }}"/>
                                        </div>

                                        <div class="col-md-6 mb-1">
                                            <label class="form-label" for="username">Credit Card Limit</label>
                                            <input type="text" name="credit_card_detail"  class="form-control" placeholder="Credit Card Limit" value="{{ old('credit_card_detail') }}"/>
                                        </div>

                                        <div class="col-md-6 mb-1">
                                            <label class="form-label" for="username">Outstanding  </label>
                                            <input type="text" name="card_outstanding"  class="form-control" placeholder="Outstanding" value="{{ old('outstanding') }}"/>
                                        </div>

                                        <div class="col-md-6 mb-1">
                                            <label class="form-label" for="username">Loan Obligation</label>
                                            <input type="text" name="card_locan_obligation"  class="form-control" placeholder="Loan Obligation" value="{{ old('locan_obligation') }}"/>
                                        </div>

                                        <div class="border-top mb-1"></div>
                                        <div class="text-center">
                                            <h2 class="head">Employment Details </h2>
                                        </div>

                                        <div class="col-md-6 mb-1">
                                            <label class="form-label" for="username">Name Of Employer/Business   </label>
                                            <input type="text" name="name_of_emp_buss"  class="form-control" placeholder="Name Of Employer/Business" value="{{ old('name_of_emp_buss') }}"/>
                                        </div>

                                        <div class="col-md-6 mb-1">
                                            <label class="form-label" for="username">Employer Code </label>
                                            <input type="text" name="employer_code"  class="form-control" placeholder="Employer Code" value="{{ old('employer_code') }}"/>
                                        </div>

                                        <div class="col-md-6 mb-1">
                                            <label class="form-label" for="username">Designation   </label>
                                            <input type="text" name="designation"  class="form-control" placeholder="Designation" value="{{ old('designation') }}"/>
                                        </div>

                                        <div class="col-md-6 mb-1">
                                            <label class="form-label" for="username">City/District *</label>
                                            <input type="text" name="city_district"  class="form-control" placeholder="City/District" value="{{ old('city_district') }}"/>
                                        </div>

                                        <div class="col-md-3 mb-1">
                                            <label class="form-label" for="username">State</label>

                                            <select class="select2 form-select" name="transaction_id" id="stateOFCustomerDetail"  >
                                                <option value="">Select State</option>
                                                @foreach (config('constant.states') as $key => $value)
                                                    <option value="{{ $value }}">{{ $value }}</option>
                                                @endforeach
                                            </select>

                                        </div>

                                        <div class="col-md-3 mb-1">
                                            <label class="form-label" for="username">Pin </label>
                                            <input type="text" name="emp_pin"   class="form-control" placeholder="PIN" value="{{ old('emp_pin') }}"/>
                                        </div>

                                        <div class="col-md-6 mb-1">
                                            <label class="form-label" for="username">Office Address *</label>
                                            <input type="text" name="emp_office_address" class="form-control" placeholder="Office Address" value="{{ old('emp_office_address') }}"/>
                                        </div>

                                        <div class="border-top mb-1"></div>
                                        <div class="text-center">
                                            <h2 class="head">Loan Details </h2>
                                        </div>

                                        <div class="col-md-6 mb-1">
                                            <label class="form-label" for="username">Loan Amount </label>
                                            <input type="text" name="loan_amount"  class="form-control" required placeholder="Loan Amount" value="@if(isset($application_form->loan_amount)){{$application_form->loan_amount}}@else{{ old('loan_amount') }}@endif"/>
                                        </div>

                                        <div class="col-md-6 mb-1">
                                            <label class="form-label" for="username">Rate Of Intrest </label>
                                            <input type="number" name="rate_of_interest"  class="form-control" required placeholder="Rate Of Intrest" value="@if(isset($application_form->rate_of_interest)){{$application_form->rate_of_interest}}@else{{ old('rate_of_interest') }}@endif"/>
                                        </div>

                                        <div class="col-md-6 mb-1">
                                            <label class="form-label" for="username">Tenure </label>
                                            <input type="text" name="tenure"  class="form-control" placeholder="Tenure" value="@if(isset($application_form->tenure)){{$application_form->tenure}}@else{{ old('tenure') }}@endif"/>
                                        </div>

                                        <div class="col-md-6 mb-1">
                                            <label class="form-label" for="username">Loan Type</label>
                                            <select class="select2 form-select" name="loan_type" id="loan_type" required >
                                                <option value="">Select State</option>
                                                @foreach (config('constant.loan_type') as $key => $value)
                                                    <option value="{{ $key }}"  {{ (isset($application_form->loan_type) && $application_form->loan_type == $key) ? 'selected' : '' }} >{{ $value }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-6 mb-1">
                                            <label class="form-label" for="username">Application date</label>
                                            <input type="date" name="application_date"  class="form-control" required placeholder="Application Date" value="@if(isset($application_form->application_date)){{$application_form->application_date}}@else{{ old('application_date') }}@endif"/>
                                        </div>

                                        <div class="col-md-3 mb-1">
                                            <label class="form-label" for="username">Additional Charges </label>
                                            <input type="text" name="additional_charge"  class="form-control" required placeholder="Additional Charges" value="@if(isset($application_form->additional_charge)){{$application_form->additional_charge}}@else{{ old('additional_charge')}}@endif"/>
                                        </div>

                                        <div class="col-md-3 mb-1">
                                            <label class="form-label" for="username">Emi Amount</label>
                                            <input type="text" name="emi_amount"  class="form-control" required placeholder="Emi Amount" value="@if(isset($application_form->emi_amount)){{$application_form->emi_amount}}@else{{ old('emi_amount') }}@endif"/>
                                        </div>

                                    </div>

                                    <div class="d-flex justify-content-between">
                                        <button class="btn btn-outline-secondary btn-prev" disabled>
                                            <i data-feather="arrow-left" class="align-middle me-sm-25 me-0"></i>
                                            <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                        </button>
                                        <button class="btn btn-primary btn-next" type="submit">
                                            <span class="align-middle d-sm-inline-block d-none">Next</span>
                                            <i data-feather="arrow-right" class="align-middle ms-sm-25 ms-0"></i>
                                        </button>
                                    </div>
                                    
                                </form>
                                
                            </div>
                           
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection