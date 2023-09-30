
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
                            <h2 class="content-header-title float-start mb-0">Journal Entries</h2>
                            <div class="breadcrumb-wrapper">
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
                                                <th>DESCRIPTION</th>
                                                <th>DR</th>
                                                <th>CR</th>
                                                {{-- <th>Loan ID</th> --}}
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php  $i=1; $k=0; @endphp
                                            @foreach ($journal_entries as $item)
                                                <tr>
                                                    <td>@if ($item->type == 'dr')  <?php if($k != $i){ echo $i; } $k = $i; ?>   @endif </td>
                                                    @if ($item->type == 'dr')
                                                        <td><h5>{{ $item->ledger_account }}</h5></td>
                                                    @else
                                                        <td style="text-align: center;"><h5> To {{ $item->ledger_account }}</h5>
                                                            
                                                            ( {{ $item->description }} )
                                                        </td>
                                                    @endif
                                                    <th class="text-success">
                                                        @if ($item->type == 'dr')
                                                            {{ $item->amount }}
                                                        @endif
                                                    </th>
                                                    <th class="text-danger">
                                                        @if ($item->type == 'cr')
                                                            {{ $item->amount }}
                                                        @endif
                                                    </th>
                                                    @php if($item->type == 'cr'){$i++; } @endphp

                                                    {{-- @if ($item->type == 'cr')
                                                        <td class="text-primary">
                                                            {{ $item->loan_id }}
                                                        </td>    
                                                    @endif --}}

                                                    @if ($item->type == 'cr')
                                                        <td>
                                                            {{ date('d M Y H:i:s',strtotime($item->created_at)) }}
                                                        </td>    
                                                    @endif
                                                    
                                                </tr>
                                                
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>

                                @include('_pagination', ['data' => $journal_entries])

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