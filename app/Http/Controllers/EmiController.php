<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Emi;
use App\Models\LoanApplication;
use Illuminate\Http\Request;

class EmiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Emi  $emi
     * @return \Illuminate\Http\Response
     */
    public function show($loan_id)
    {
        $emis = Emi::where('loan_id',$loan_id)->get();
        $due_emi_amount = 0;
        $due_emi_principal = 0;
        $due_emi_interet = 0;

        foreach($emis as $key=>$val){
            if(strtotime($val->emi_date) <= strtotime(date('Y-m-d'))){
                if(date('m-Y',strtotime($val->emi_date)) == date('m-Y')){
                    $val->emi_status = 1;
                    $due_emi_amount += $val->due_amount; 
                    $due_emi_principal += $val->principal; 
                    $due_emi_interet += $val->interest; 
                }else{
                    $val->emi_status = 0;
                    $due_emi_amount += $val->due_amount;
                    $due_emi_principal += $val->principal; 
                    $due_emi_interet += $val->interest; 
                }
            }else{
                $val->emi_status = 2;
            }
            $val->pri_rat = $val->principal * 100 / $val->emi;
        }
        $dues_data = [
            'due_emi_amount' => $due_emi_amount,
            'due_emi_principal' => $due_emi_principal,
            'due_emi_interet' => $due_emi_interet,
            'net_total_amount' => $due_emi_amount,
        ];
        $loan_application = LoanApplication::find($loan_id);
        $customer = Customer::find($loan_application->customer_id);
        return view('emi.show',compact('emis','loan_application','customer','dues_data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Emi  $emi
     * @return \Illuminate\Http\Response
     */
    public function edit(Emi $emi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Emi  $emi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Emi $emi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Emi  $emi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Emi $emi)
    {
        //
    }

    


}
