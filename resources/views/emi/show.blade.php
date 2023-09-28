
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
    .pr_int{
        font-size: 13px;
        font-weight: bold;
        /* color: red; */
    }

    .title_loan{
        text-align: center;
        padding: 1%;
        background-color: #65c06d;
        color: white;
        font-size: 19px;
    }
    .title_loan_2{
        text-align: center;
        padding: 1%;
        background-color: #656dc0;
        color: white;
        font-size: 19px;
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
                            <h2 class="content-header-title float-start mb-0"> Loan Emi </h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a>
                                    </li>
                                    
                                    <li class="breadcrumb-item"><a href="{{ route('emi_collect') }}">Collect EMI</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Loan ID : {{ $loan_application->loan_id }}</a>
                                    </li>
                                    <li class="breadcrumb-item active">Emi List
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
                        <div class="col-md-7">
                            <div class="card">
                                
                                <div class="card-datatable">
                                    <table class="datatables-ajax table table-responsive">
                                        <thead>
                                            <tr>
                                                <th>Emi No.</th>
                                                <th>Emi Amount</th>
                                                {{-- <th>principal</th> --}}
                                                {{-- <th>interest</th> --}}
                                                <th>Emi Date</th>
                                                <th>Due Amount</th>
                                                <th>Status</th>
                                                <th>Pay Emi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php  $i=1; @endphp
                                            @foreach($emis as $key => $val)
                                            
                                            <tr>
                                                <input type="hidden" id="principle_rat_{{$val->id}}" value="{{ $val->pri_rat }}">
                                                <th scope="row">{{ $val->emi_number }}</th>
                                                <th><a href="#">{{ $val->emi }}</a><br> <span style="font-size: 10px;">({{ $val->principal }} + {{ $val->interest }})</span>
                                                </th>
                                                <td class="text-dark">{{ date('d-M-Y',strtotime($val->emi_date)) }}</td>
                                                <td>
                                                    @if ($val->status != 1)
                                                        <input type="number" @if ($val->emi_status == 2) @readonly(true)    @endif 
                                                            value="{{ $val->due_amount }}" min="0" max="{{ $val->due_amount }}" class="form-control" id="emi_value_{{ $val->id }}" principal_rate="{{ $val->pri_rat }}"
                                                            onchange="calculate()"
                                                            >
                                                            <span class="pr_int" ><span class="text-success">PRI : </span> <span id="span_principal_{{ $val->id }}">{{ $val->principal }}</span> ,
                                                            <span class="text-warning"> INT :</span> <span id="span_interest_{{ $val->id }}" >{{ $val->interest }}</span> </span>
                                                    @else
                                                        <h5 class="text-primary">EMI Paid</h5>
                                                        <span class="text-dark">{{ date('d-M-Y',strtotime($val->partial_date)) }}</span>
                                                    @endif
                                                </td> 
                                                @if ($val->status == 1)
                                                    <td class="avatar bg-light-success me-2">Paid</td>    
                                                @elseif ($val->emi_status == 0)
                                                    <td class="avatar bg-light-danger me-2">Overdue</td>
                                                   
                                                @elseif ($val->emi_status == 2)
                                                    <td class="avatar bg-light-info me-2">Upcoming</td>
                                                    @elseif ($val->emi_status == 1)
                                                    <td ><span class="avatar bg-light-warning me-2">Due</span><br>
                                                        @if ($val->partial_date)
                                                            <span class="text-dark">{{ date('d-M-Y',strtotime($val->partial_date)) }}</span>
                                                        @endif
                                                    </td>
                                                @endif

                                                <td>
                                                    @if ($val->status != 1)
                                                        <div class="form-check form-check-primary form-switch">
                                                            <input class="form-check-input checked_checkbox" id="toggle_{{ $val->id }}" type="checkbox" @if ($val->emi_status != 2 && $val->status != 1)
                                                                checked
                                                            @elseif ($val->status == 1)
                                                                @disabled(true)
                                                            @endif value="{{ $val->emi_status }}" onclick="checkEmi(this)" emi_status="{{ $val->emi_status }}" emi_id="{{ $val->id }}">
                                                        </div>    
                                                    @endif
                                                    
                                                </td>

                                               
                                                
                                            </tr>
                                            @php $i++; @endphp
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>

                                {{-- @include('_pagination', ['data' => $loan_application]) --}}

                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="card">
                                <div class="title_loan">Loan Account Info</div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <ul style="list-style: none;">
                                                <li><h6>Loan ID  </h6></li>
                                                <li><h6>Member  </h6></li>
                                                <li><h6>Open Date </h6></li>
                                                <li><h6>Loan Amount </h6></li>
                                                <li><h6>Rate of interest  </h6></li>
                                                <li><h6>Interest  </h6></li>
                                                <li><h6>Emi  </h6></li>
                                                <li><h6>Total Amount  </h6></li>
                                                <li><h6>Tenure  </h6></li>
                                                <li><h6>Due EMI </h6></li>
                                            </ul>
                                        </div>
                                        <div class="col-md-7">
                                            
                                            <ul style="list-style: none;">
                                                <li><h6>:  {{ $loan_application->loan_id }}</h6></li>
                                                <li><h6>: <span>{{ $customer->first_name }} {{ $customer->last_name }}</span></h6></li>
                                                <li><h6 class="">: {{ $loan_application->created_at }}</h6></li>
                                                <li><h6 class="text-success">: {{ number_format($loan_application->loan_amount, 0, '.', ',') }}</h6></li>
                                                <li><h6>:  {{ $loan_application->rate_of_interest }}%</h6></li>
                                                <li><h6 class="text-danger">: {{ number_format($loan_application->emi, 0, '.', ',') }}</h6></li>
                                                <li><h6>: {{ number_format($loan_application->interest_amount, 0, '.', ',') }}</h6></li>
                                                <li><h6>: {{ number_format($loan_application->total_amount_paid, 0, '.', ',') }}</h6></li>
                                                <li><h6>: {{ $loan_application->tenure }}</h6></li>
                                                <li><h6>: {{ $loan_application->tenure }}</h6></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="title_loan_2">Transaction Detail</div>
                                <form action="{{ route('pay_emi') }}" method="POST" onsubmit="return onSubmitForm()">
                                    @csrf
                                    <div class="card-body">
                                        <input type="hidden" name="emi_dues" value="" id="emi_to_pay_details">
                                        <input type="hidden" name="loan_id" value="{{ $loan_application->id }}">
                                        <div class="row">
                                            <div class="col-md-6 mb-1">
                                                <label for="">Transaction Date</label>
                                                <input type="date" name="transaction_date" class="form-control" required value="{{ date('Y-m-d') }}">
                                            </div>
                                            <div class="col-md-6 mb-1">
                                                <label for="">Net Emi to Collect </label>
                                                <input type="number" id="net_collet_emi" name="total_emi" readonly class="form-control" value="" required>
                                            </div>
                                            <div class="col-md-6 mb-1">
                                                <label for="">Interest Amount </label>
                                                <input type="number" id="total_interest" name="total_interest" readonly class="form-control" required  value="">
                                            </div>
                                            <div class="col-md-6 mb-1">
                                                <label for="">Principal Amount </label>
                                                <input type="number" readonly class="form-control" name="total_principal" required id="total_principal" value="">
                                            </div>
                                            <div class="col-md-6 mb-1">
                                                <label for="">Total Days Of Penalty </label>
                                                <input type="number" class="form-control"  value="" name="penalty_days">
                                            </div>
                                            <div class="col-md-6 mb-1">
                                                <label for="">Adjusted Penalty Amount </label>
                                                <input type="number" id="penelty_amount" class="form-control" name="penalty_amount" value="0" min="0" onchange="calculate()">
                                            </div>
                                            <div class="col-md-6 mb-1">
                                                <label for="">Net Amount To Collect  </label>
                                                <input type="number" readonly id="net_total_amount" class="form-control" required name="total_amount" value="">
                                            </div>
                                            <div class="col-md-6 mb-1">
                                                <label for="">Payment Mode </label>
                                                <select class="select2 form-select" name="payment_mode" id=""  required >
                                                    @foreach (config('constant.emi_payment_mode') as $key => $value)
                                                        <option value="{{ $key }}" >{{ $value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-12 mb-1">
                                                <label for="">Remarks (if any)</label>
                                                <textarea name="remark" id="" cols="3" rows="3" class="form-control"></textarea>
                                            </div>
                                            <div class="col-md-12 mb-1" style="text-align: center">
                                                <button class="btn btn-success">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                
                            </div>
            
                        </div>
                    </div>
                </section>

                <section id="ajax-datatable">
                    <div style="    text-align: end;">
                        <input type="text">
                        <a href="{{ route('journal_entries.show',$loan_application->id) }}"><button class="btn btn-dark" > Journal Entry</button></a>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                
                                <div class="card-datatable">
                                    <table class="datatables-ajax table table-responsive">
                                        <thead>
                                            <tr>
                                                <th>Transaction ID</th>
                                                <th>Amount</th>
                                                <th>principal</th>
                                                <th>interest</th>
                                                <th>penalty days</th>
                                                <th>penalty amount</th>
                                                <th>net amount</th>
                                                <th>Emi Count</th>
                                                <th>Comment</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php  $i=1; @endphp
                                            @foreach($transactions as $key => $val)
                                                <tr>
                                                    <td><a href="#">{{ $val->transaction_id }}</a></td>
                                                    <td>{{ $val->amount }}</td>
                                                    <td>{{ $val->principal }}</td>
                                                    <td>{{ $val->interest }}</td>
                                                    <td>{{ $val->penalty_day }}</td>
                                                    <td>{{ $val->penalty_amount }}</td>
                                                    <td>{{ $val->net_amount }}</td>
                                                    <td><span class="avatar bg-light-warning me-2">{{ $val->emi_count }}</span>
                                                        
                                                        <a href="#" data-bs-toggle="modal" data-bs-target="#danger_ke{{ $val->id }}"><i class="fa fa-eye"></i></a>

                                                        <div class="modal fade modal- text-start" id="danger_ke{{ $val->id }}" tabindex="-1" aria-labelledby="myModalLabel120" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                                                
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="myModalLabel120">TR.No : {{ $val->transaction_id }}</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <table class="datatables-ajax table table-responsive">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>Sr.no</th>
                                                                                        <th>emi month</th>
                                                                                        <th>Amount</th>
                                                                                        <th>principal</th>
                                                                                        <th>interest</th>
                                                                                        {{-- <th>transaction Date</th> --}}
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    @php  $i=1; @endphp
                                                                                    @foreach($val->emis as $key => $items)
                                                                                        <tr>
                                                                                            <td>{{ $i }}</td>
                                                                                            <th>{{ date('M,Y',strtotime($items->emi_date)) }}</th>
                                                                                            <td>{{ $items->principal }}</td>
                                                                                            <td>{{ $items->interest }}</td>
                                                                                            <td>{{ $items->amount }}</td>
                                                                                            {{-- <td>{{ date('d M Y H:i:s',strtotime($val->created_at)) }}</td> --}}
                                                                                        </tr>
                                                                                    @php $i++; @endphp
                                                                                    @endforeach
                                                                                    <tr style="background-color: #dfc699;
                                                                                    color;">
                                                                                        <th></th>
                                                                                        <th>TOTAL</th>
                                                                                        <th>{{ $val->principal }}</th>
                                                                                        <th>{{ $val->interest }}</th>
                                                                                        <th>{{ $val->amount }}</th>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                            </div>
                                                        </div>

                                                        {{-- {{ $val->emis }} --}}
                                                    
                                                    
                                                    </td>
                                                    <td>{{ $val->comment }}</td>
                                                </tr>
                                            @php $i++; @endphp
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>

                                {{-- @include('_pagination', ['data' => $loan_application]) --}}

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


    


    <script>
        function checkEmi(checkboxElement) {
            var emiStatus = checkboxElement.getAttribute('emi_status');
            var emiId = checkboxElement.getAttribute('emi_id');
            var kkpInput = document.getElementById('emi_value_'+emiId);
            if (checkboxElement.checked) {
                if(emiStatus == 2){
                    var confirmed = window.confirm('Are you sure you want to pay emi in advance?');
                    if (confirmed) {
                        kkpInput.readOnly = false;
                    } else {
                        checkboxElement.checked = false;
                    }
                }else{
                    kkpInput.readOnly = false;
                }
            }else{
                kkpInput.readOnly = true;   
            }
            calculate();
        }

        function calculate(){
            const checkboxes = document.querySelectorAll('.checked_checkbox');
            let total_principal = 0;
            let total_interest = 0;
            let total_emi = 0;
            const emi_values_pay = [];
            checkboxes.forEach((checkbox) => {
                if (checkbox.checked) {
                    let emi_id = checkbox.getAttribute('emi_id');
                    let emi_values = document.getElementById('emi_value_'+emi_id);
                    let emi = emi_values.value;
                    let principal_rate = emi_values.getAttribute('principal_rate');
                    let principle_amount_2 = emi * principal_rate /100;
                    let principle_amount = Math.round(principle_amount_2)
                    let interest_amount = emi - principle_amount;
                    total_principal += principle_amount;
                    total_interest += interest_amount;
                    total_emi += Math.round(emi);
                    document.getElementById('span_interest_'+emi_id).textContent = interest_amount;
                    document.getElementById('span_principal_'+emi_id).textContent = principle_amount;
                    const emi_detail ={ emi_id :emi_id,pay_amount: emi ,principal:principle_amount, interest:interest_amount };
                    emi_values_pay.push(emi_detail);
                }
            });
            let penelty_amount = document.getElementById('penelty_amount').value;
            document.getElementById('net_collet_emi').value = total_emi;
            document.getElementById('total_principal').value = total_principal;
            document.getElementById('total_interest').value = total_interest;
            document.getElementById('net_total_amount').value = total_emi + Math.round(penelty_amount);
            const emi_to_pay_details = JSON.stringify(emi_values_pay);
            document.getElementById('emi_to_pay_details').value = emi_to_pay_details;
        }
    </script>

    <script>
        calculate();
    </script>

<script>
    function onSubmitForm() {
        let amount = document.getElementById('net_total_amount').value;
        const confirmed = window.confirm('Are you sure you want to pay emi '+amount+' ?');
        if (confirmed) {
            
        } else {
            alert('Form submission canceled'); 
            return false;
        }
    }
</script>

@endsection