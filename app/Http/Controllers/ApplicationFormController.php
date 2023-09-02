<?php

namespace App\Http\Controllers;

use App\Models\ApplicationForm;
use App\Models\Customer;
use App\Models\Enquiry;
use Illuminate\Http\Request;

class ApplicationFormController extends Controller
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
    public function create($enquiry_id)
    {   
        $enquiry = Enquiry::where('enquiry_id',$enquiry_id)->first();
        $application_form = ApplicationForm::where('enquiry_id',$enquiry->id)->first();
        $customer = Customer::where(['enquiry_id' => $enquiry->id ,'type' => Customer::$customer])->first();
        return view('application-forms.create',compact('enquiry','application_form','customer'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        ApplicationForm::updateOrCreate(['enquiry_id' => $request->enquiry_id],[
            'enquiry_id' => $request->enquiry_id,
            'enrollment_date' => $request->enrollment_date,
            'processing_fees' => isset($request->processing_fees) ? $request->processing_fees : 0,
            'payment_mode' => $request->payment_mode,
            'payment_mode_desc' => $request->payment_mode_desc,
            'loan_amount' => $request->loan_amount,
            'rate_of_interest' => $request->rate_of_interest,
            'tenure' => $request->tenure,
            'loan_type' => $request->loan_type,
            'application_date' => $request->application_date,
            'additional_charge' => $request->additional_charge,
            'emi_amount' => $request->emi_amount,
        ]);

        Customer::updateOrCreate(['enquiry_id' => $request->enquiry_id ,'type' => Customer::$customer],[
            'enquiry_id' => $request->enquiry_id,
            'type' => Customer::$customer,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'title' => $request->customer_title,
            'gender' => $request->customer_gender,
            'mobile' => $request->mobile,
            'dob' => $request->dob,
            'qualification' => $request->qualification,
            'occupation' => $request->occupation,
            'reference_mobile' => $request->old_customer_mobile,
            'father_name' => $request->father_name,
            'mother_name' => $request->mother_name,
            'spouse_name' => $request->spouse_name,
            'alternative_mobile' => $request->alternative_mobile,
            'email' => $request->email,
            'marital_status' => $request->marital_status,
            'yearly_income' => $request->yearly_income,
        ]);
        return redirect()->back()->with('success','Save Update success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ApplicationForm  $applicationForm
     * @return \Illuminate\Http\Response
     */
    public function show(ApplicationForm $applicationForm)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ApplicationForm  $applicationForm
     * @return \Illuminate\Http\Response
     */
    public function edit(ApplicationForm $applicationForm)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ApplicationForm  $applicationForm
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ApplicationForm $applicationForm)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ApplicationForm  $applicationForm
     * @return \Illuminate\Http\Response
     */
    public function destroy(ApplicationForm $applicationForm)
    {
        //
    }

   


}
