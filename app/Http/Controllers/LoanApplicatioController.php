<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\LoanApplication;
use Illuminate\Http\Request;

class LoanApplicatioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
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
     * @param  \App\Models\LoanApplication  $loanApplication
     * @return \Illuminate\Http\Response
     */
    public function show(LoanApplication $loanApplication)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LoanApplication  $loanApplication
     * @return \Illuminate\Http\Response
     */
    public function edit(LoanApplication $loanApplication)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LoanApplication  $loanApplication
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LoanApplication $loanApplication)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LoanApplication  $loanApplication
     * @return \Illuminate\Http\Response
     */
    public function destroy(LoanApplication $loanApplication)
    {
        //
    }

    public function dishbushment($id, Request $request){
        $loan_type = Helper::getLoneName($id);
        $page = $request->input('page',1);
        $loan_application = LoanApplication::where('loan_applications.loan_type', $id)
        ->join('customers', 'loan_applications.customer_id', '=', 'customers.id')
        ->join('application_forms','loan_applications.application_id','=','application_forms.id')
        ->select(['loan_applications.*', 'customers.first_name','customers.last_name','customers.mobile','application_forms.application_id'])->paginate(10, ['*'], 'page',$page);
        return view('disbushment.index',compact('loan_application','loan_type'));
    }

    public function emiCollect(Request $request){
        $loan_type = "";
        $page = $request->input('page',1);
        $loan_application = LoanApplication::
        join('customers', 'loan_applications.customer_id', '=', 'customers.id')
        ->join('application_forms','loan_applications.application_id','=','application_forms.id')
        ->select(['loan_applications.*', 'customers.first_name','customers.last_name','customers.mobile','application_forms.application_id'])->paginate(10, ['*'], 'page',$page);
        foreach($loan_application  as $key=>$val){
            $val->loan_type = Helper::getLoneName($val->loan_type);
        }
        return view('emi.emi_collect',compact('loan_application','loan_type'));

    }
}
