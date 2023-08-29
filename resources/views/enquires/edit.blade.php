


@extends('layouts.app')

@section('content')

 <!-- BEGIN: Content-->
 <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Payment Status</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ url('/')}}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Payment-status </a>
                                    </li>
                                    <li class="breadcrumb-item active">Edit
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
                                    <h4 class="card-title">Edit</h4>
                                </div>
                                <div class="card-body">
                                    

                                    <form class="form" action="{{ route('products.update',$product->id) }}" method="POST" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        @method('PATCH')
                                    
                                        <div class="row">
                                            <div class="col-md-8 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Name <span class="error">*</span></label>
                                                    <input type="text" id="first-name-column" name="name" class="form-control" placeholder="Name" oninput=""  value="{{ $product->name }}" />
                                                </div>
                                            </div>

                                            <div class="col-md-1 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Status <span class="error">*</span></label>
                                                    <div class="form-check form-check-primary form-switch">
                                                        <input class="form-check-input checked_chackbox" id="systemNotification" type="checkbox" name="status"  value="1"  
                                                            @if ($product->status == 1)
                                                                @checked(true)
                                                            @endif
                                                        >
                                                    </div>
                                                </div>
                                            </div>
                                            
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