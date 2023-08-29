


@extends('layouts.app')

@section('content')

<style>
    .error{
        color:red;
    }
    /* input {
        text-transform: uppercase;
    } */
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

                <!-- Basic multiple Column Form section start -->
                <section id="multiple-column-form">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    {{-- <h4 class="card-title">Create</h4> --}}
                                </div>
                                <div class="card-body">
                                    <form class="form" action="{{ route('enquires.store') }}" method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    
                                        <div class="row">

                                            <div class="col-md-3 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">First Name <span class="error">*</span></label>
                                                    <input type="text" id="first-name-column" name="first_name" class="form-control" placeholder="First Name" oninput=""  value="{{ old('first_name') }}" />
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Last Name <span class="error">*</span></label>
                                                    <input type="text" id="first-name-column" name="last_name" class="form-control" placeholder="Last Name" oninput=""  value="{{ old('last_name') }}" />
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Mobile <span class="error">*</span></label>
                                                    <input type="number" id="first-name-column" name="mobile" class="form-control" placeholder="Mobile" oninput=""  value="{{ old('mobile') }}" />
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Address Line 1 <span class="error">*</span></label>
                                                    <textarea name="address" id="" cols="2" rows="2" class="form-control" placeholder=" Address line 1">{{ old('address') }}</textarea>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Address Line 2 <span class="error"></span></label>
                                                    <textarea name="address_2" id="" cols="2" rows="2" class="form-control" placeholder=" Address line 2">{{ old('address_2') }}</textarea>
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">City <span class="error">*</span></label>
                                                    <input type="text" id="first-name-column" name="city" class="form-control" placeholder="City" oninput=""  value="{{ old('city') }}" />
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">PIN Code <span class="error">*</span></label>
                                                    <input type="number" id="first-name-column" name="pin_code" class="form-control" placeholder="Pin Code" oninput=""  value="{{ old('pin_code') }}" />
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Login Charge <span class="error">*</span></label>
                                                    <input type="number" id="first-name-column" name="login_charge" class="form-control" placeholder="Login Charge In Amount" oninput=""  value="{{ old('login_charge') }}" />
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Payment Mode <span class="error">*</span></label>
                                                    <br>
                                                    
                                                    <input type="radio" id="first-name-column" name="login_charge" placeholder="Login Charge In Amount" oninput=""  value="{{ old('login_charge') }}" />
                                                    <span>Cash</span>
                                                    &nbsp;&nbsp;&nbsp;
                                                    <input type="radio" id="first-name-column" name="login_charge" placeholder="Login Charge In Amount" oninput=""  value="{{ old('login_charge') }}" />
                                                    <span>Online Transaction</span>

                                                </div>
                                            </div>

                                            <div class="border-top mb-1"></div>

                                            <div class="col-md-12 col-12">
                                                <div class="mb-1" style="text-align:center">
                                                    <h3>Customer's Document</h3>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Aadhar Number <span class="error">*</span></label>
                                                    <input type="number" id="first-name-column" name="aadhar_number" class="form-control" placeholder="Aadhar Number" oninput=""  value="{{ old('aadhar_number') }}" />
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Aadhar Upload <span class="error">*</span></label>
                                                    <input type="file" id="first-name-column" name="aadhar_doc" class="form-control"  />
                                                </div>
                                            </div>

                                            <div class="col-md-3"></div>

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Voter ID No.<span class="error">*</span></label>
                                                    <input type="number" id="first-name-column" name="vode_id" class="form-control" placeholder="Voter ID No." oninput=""  value="{{ old('vode_id') }}" />
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Voter ID Upload <span class="error">*</span></label>
                                                    <input type="file" id="first-name-column" name="voder_doc" class="form-control"  />
                                                </div>
                                            </div>

                                            <div class="col-md-3"></div>

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Pan No.<span class="error">*</span></label>
                                                    <input type="number" id="first-name-column" name="pan_number" class="form-control" placeholder="Pan Number" oninput=""  value="{{ old('pan_number') }}" />
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Pan Upload <span class="error">*</span></label>
                                                    <input type="file" id="first-name-column" name="pan_doc" class="form-control"  />
                                                </div>
                                            </div>
                                            <div class="col-md-3"></div>

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Other Document<span class="error">*</span></label>
                                                    <input type="number" id="first-name-column" name="other_document" class="form-control" placeholder="Other Document" oninput=""  value="{{ old('other_document') }}" />
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Other Document Upload<span class="error">*</span></label>
                                                    <input type="file" id="first-name-column" name="other_doc" class="form-control"  />
                                                </div>
                                            </div>

                                            <div class="col-md-3"></div>

                                            

                                            

                                            
                                            
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary me-1">Submit</button>
                                                <button type="reset" class="btn btn-outline-secondary">Reset</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Basic Floating Label Form section end -->

            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection