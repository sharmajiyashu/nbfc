<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Customer;
use App\Models\Emi;
use App\Models\EmiTransaction;
use App\Models\JournalEntry;
use App\Models\LedgerAccount;
use App\Models\LoanApplication;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
        $transactions = Transaction::where('loan_id',$loan_id)->get()->map(function($transaction){
            $emi_ids = json_decode($transaction->emi_ids);
            $transaction['emis'] = EmiTransaction::whereIn('id',$emi_ids)->get()->map(function($emi){
                $emi->emi_date = Emi::find($emi->emi_id)->emi_date;
                return $emi;
            });
            return $transaction;
        });
        return view('emi.show',compact('emis','loan_application','customer','dues_data','transactions'));
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

    function payEmi(Request $request){
        try {
            DB::beginTransaction();
            $total_emi = json_decode($request->emi_dues);
            $total_emi_amount = 0;
            $total_interest_amount = 0;
            $total_principal_amount = 0;
            $emi_count = 0;
            $emi_ids = [];
            foreach($total_emi as $key => $val){
                $get_emi = Emi::find($val->emi_id);
                if($get_emi){
                    if($get_emi->due_amount >= $val->pay_amount){
                        $due_amount = $get_emi->due_amount - $val->pay_amount;
                        $emi_data_update = [
                            'due_amount' => $due_amount,
                            'partial_date' => date('Y-m-d'),
                        ];
                        if($due_amount == 0){
                            $emi_data_update['status'] = Emi::$paid;
                        }
                        $total_emi_amount += $val->pay_amount;
                        $total_interest_amount += $val->interest;
                        $total_principal_amount += $val->principal;
                        $emi_count ++;
                        
                        Emi::where('id',$get_emi->id)->update($emi_data_update);
                        $emi_transaction = EmiTransaction::create(['emi_id' => $get_emi->id,'loan_id' => $get_emi->loan_id,'amount' => $val->pay_amount, 'principal' => $val->principal ,'interest' => $val->interest]);
                        $emi_ids[] = $emi_transaction->id;
                    }
                }
            }
            $net_amount = $total_emi_amount + $request->penalty_amount;
            Transaction::create([
                'loan_id' => $request->loan_id,
                'transaction_type' => Transaction::$emi,
                'amount' => $total_emi_amount,
                'interest' => $total_interest_amount,
                'principal' => $total_principal_amount,
                'penalty_amount' => $request->penalty_amount,
                'penalty_day' => $request->penalty_days,
                'net_amount' => $net_amount,
                'comment' => $request->remark,
                'emi_count' => $emi_count,
                'emi_ids' => json_encode($emi_ids),
                'payment_mode' => $request->payment_mode,
                'payment_mode_dsc' => ''
            ]);

            $loan = LoanApplication::find($request->loan_id);
            $customer = Customer::where('id',$loan->customer_id)->first();
            
            Helper::setDefaultGeneralAccount();
            $ledger_account = LedgerAccount::updateOrCreate(['loan_id' => $loan->id],[
                'loan_id' => $loan->id,
                'name' => $customer->first_name.' '.$customer->last_name,
            ]);

            $group = JournalEntry::count();

            if($net_amount > 0){
                JournalEntry::create([
                    'group_id' => $group,
                    'ledger_id' => LedgerAccount::$cash,
                    'description' => 'with amount of paying emi',
                    'loan_id' => $loan->id,
                    'amount' => $net_amount,
                    'type' => 'dr'
                ]);
    
                JournalEntry::create([
                    'group_id' => $group,
                    'ledger_id' => $ledger_account->id,
                    'description' => 'with amount of paying emi',
                    'loan_id' => $loan->id,
                    'amount' => $net_amount,
                    'type' => 'cr'
                ]);
            }

            // emi interest 
            if($total_interest_amount > 0){
                JournalEntry::create([
                    'group_id' => $group,
                    'ledger_id' => $ledger_account->id,
                    'description' => 'with amount of emi interest',
                    'loan_id' => $loan->id,
                    'amount' => $total_interest_amount,
                    'type' => 'dr'
                ]);
    
                JournalEntry::create([
                    'group_id' => $group,
                    'ledger_id' => LedgerAccount::$emi_interest,
                    'description' => 'with amount of emi interest',
                    'loan_id' => $loan->id,
                    'amount' => $total_interest_amount,
                    'type' => 'cr'
                ]);
    
                JournalEntry::create([
                    'group_id' => $group,
                    'ledger_id' => LedgerAccount::$emi_interest,
                    'description' => 'with amount of emi interest',
                    'loan_id' => $loan->id,
                    'amount' => $total_interest_amount,
                    'type' => 'dr'
                ]);
    
                JournalEntry::create([
                    'group_id' => $group,
                    'ledger_id' => LedgerAccount::$profit_and_loss,
                    'description' => 'with amount of emi interest',
                    'loan_id' => $loan->id,
                    'amount' => $total_interest_amount,
                    'type' => 'cr'
                ]);
            }

            // penalty_amount
            if($request->penalty_amount > 0){
                JournalEntry::create([
                    'group_id' => $group,
                    'ledger_id' => $ledger_account->id,
                    'description' => 'with amount of penalty amount',
                    'loan_id' => $loan->id,
                    'amount' => $request->penalty_amount,
                    'type' => 'dr'
                ]);
    
                JournalEntry::create([
                    'group_id' => $group,
                    'ledger_id' => LedgerAccount::$penalty_amount,
                    'description' => 'with amount of penalty amount',
                    'loan_id' => $loan->id,
                    'amount' => $request->penalty_amount,
                    'type' => 'cr'
                ]);
    
                JournalEntry::create([
                    'group_id' => $group,
                    'ledger_id' => LedgerAccount::$penalty_amount,
                    'description' => 'with amount of penalty amount',
                    'loan_id' => $loan->id,
                    'amount' => $request->penalty_amount,
                    'type' => 'dr'
                ]);
    
                JournalEntry::create([
                    'group_id' => $group,
                    'ledger_id' => LedgerAccount::$profit_and_loss,
                    'description' => 'with amount of penalty amount',
                    'loan_id' => $loan->id,
                    'amount' => $request->penalty_amount,
                    'type' => 'cr'
                ]);
            }

            DB::commit();

            $message = $emi_count." Emi paid sccessully | Total Amount : ".$net_amount;
            return redirect()->back()->with('success',$message);
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error occurred: ' . $e->getMessage());
            return response()->json(['error' =>  $e->getMessage()], 500);
        }
    }


}
