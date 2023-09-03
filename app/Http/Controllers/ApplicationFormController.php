<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Address;
use App\Models\ApplicationForm;
use App\Models\Customer;
use App\Models\Document;
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
        if(!empty($customer->id)){
            $postal_address = Address::where('customer_id',$customer->id)->where('type',Address::$current_address)->first();
            $permanent_address = Address::where('customer_id',$customer->id)->where('type',Address::$permanent_address)->first();
            $kyc_detail = Helper::getCustomerkycDetail($customer->id);
        }else{ $postal_address = [];$permanent_address = []; $kyc_detail = [];}
        
        $enquiry_document = Helper::getEnquiryDocument($enquiry->id);
        
        return view('application-forms.create',compact('enquiry','application_form','customer','postal_address','permanent_address',
        'enquiry_document','kyc_detail'));
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

        $customer = Customer::updateOrCreate(['enquiry_id' => $request->enquiry_id ,'type' => Customer::$customer],[
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

        Address::updateOrCreate(['customer_id' => $customer->id,'type' => Address::$current_address],[
            'customer_id' => $customer->id,
            'type' => Address::$current_address,
            'address' => $request->postal_address_1,
            'address_2' => $request->postal_address_2,
            'area'=> $request->postal_area,
            'land_mark' => $request->postal_land_mark,
            'city' => $request->postal_city,
            'state' => $request->postal_state,
            'pincode' => $request->postal_pin,
            'district' => $request->postal_district,
            'country' => $request->postal_country,
        ]);

        Address::updateOrCreate(['customer_id' => $customer->id,'type' => Address::$permanent_address],[
            'customer_id' => $customer->id,
            'type' => Address::$permanent_address,
            'address' => $request->permanant_address_1,
            'address_2' => $request->permanant_address_2,
            'area'=> $request->permanant_area,
            'land_mark' => $request->permanant_land_mark,
            'city' => $request->permanant_land_mark,
            'state' => $request->permanant_state,
            'pincode' => $request->permanant_pin,
            'district' => $request->permanant_district,
            'country' => $request->permanant_pin,
        ]);
        self::uplodeKyc($customer->id,$request->only('aadhar_number','aadhar_doc','voter_id','voter_doc','pan_number','pan_doc','ration_card_number','ration_card_doc','dl_number','dl_doc','bank_statement_number','bank_statement_doc','property_paper_number','other_document_name'));
        return redirect()->back()->with('success','Save Update success');
    }

    function uplodeKyc($customer_id,$data){

        if(!empty($data['property_paper_number'])){
            $property_paper_doc = Helper::uploadDocument(isset($data['property_paper_doc']) ? $data['property_paper_doc'] : null);
            $dd_data = [
                'customer_id' => $customer_id,
                'type' => Document::$property_type,
                'name' => 'Property Type',
                'desc' => isset($data['property_paper_number']),
            ];
            if($property_paper_doc){
                $dd_data['image'] = $property_paper_doc;
            }
            $document = Document::updateOrCreate(['customer_id' => $customer_id ,'type' => Document::$property_type],$dd_data);
        }

        if(!empty($data['bank_statement_number'])){
            $bank_statement_doc = Helper::uploadDocument(isset($data['bank_statement_doc']) ? $data['bank_statement_doc'] : null);
            $dd_data = [
                'customer_id' => $customer_id,
                'type' => Document::$bank_statement,
                'name' => 'Bank Statement',
                'desc' => isset($data['bank_statement_number']),
            ];
            if($bank_statement_doc){
                $dd_data['image'] = $bank_statement_doc;
            }
            $document = Document::updateOrCreate(['customer_id' => $customer_id ,'type' => Document::$bank_statement],$dd_data);
        }

        if(!empty($data['dl_number'])){
            $dl_doc = Helper::uploadDocument(isset($data['dl_doc']) ? $data['dl_doc'] : null);
            $dd_data = [
                'customer_id' => $customer_id,
                'type' => Document::$dl,
                'name' => 'DL',
                'desc' => isset($data['dl_number']),
            ];
            if($dl_doc){
                $dd_data['image'] = $dl_doc;
            }
            $document = Document::updateOrCreate(['customer_id' => $customer_id ,'type' => Document::$dl],$dd_data);
        }

        if(!empty($data['ration_card_number'])){
            $ration_card_doc = Helper::uploadDocument(isset($data['ration_card_doc']) ? $data['ration_card_doc'] : null);
            $dd_data = [
                'customer_id' => $customer_id,
                'type' => Document::$ration_card,
                'name' => 'Ration Card',
                'desc' => isset($data['ration_card_number']),
                'image' => Helper::uploadDocument($data['ration_card_doc']),
            ];
            if($ration_card_doc){
                $dd_data['image'] = $ration_card_doc;
            }
            $document = Document::updateOrCreate(['customer_id' => $customer_id ,'type' => Document::$ration_card],$dd_data);
        }

        if(!empty($data['pan_number'])){
            $pan_doc = Helper::uploadDocument(isset($data['pan_doc']) ? $data['pan_doc'] : null);
            $dd_data = [
                'customer_id' => $customer_id,
                'type' => Document::$pan,
                'name' => 'Pan Number',
                'desc' => isset($data['pan_number']),
            ];
            if($pan_doc){
                $dd_data['image'] = $pan_doc;
            }
            $document = Document::updateOrCreate(['customer_id' => $customer_id ,'type' => Document::$pan],$dd_data);
        }

        if(!empty($data['aadhar_number'])){
            $aadhar_doc = Helper::uploadDocument(isset($data['aadhar_doc']) ? $data['aadhar_doc'] : null);
            $dd_data = [
                'customer_id' => $customer_id,
                'type' => Document::$aadhar,
                'name' => 'Aadhar Number',
                'desc' => isset($data['aadhar_number']),
            ];
            if($aadhar_doc){
                $dd_data['image'] = $aadhar_doc;
            }
            $document = Document::updateOrCreate(['customer_id' => $customer_id ,'type' => Document::$aadhar],$dd_data);
        }

        if(!empty($data['voter_id'])){
            $voter_doc = Helper::uploadDocument(isset($data['voter_doc']) ? $data['voter_doc'] : null);
            $dd_data = [
                'customer_id' => $customer_id,
                'type' => Document::$voter_id,
                'name' => 'Voter ID',
                'desc' => isset($data['voter_id']),
            ];
            if($voter_doc){
                $dd_data['image'] = $voter_doc;
            }
            $document = Document::updateOrCreate(['customer_id' => $customer_id ,'type' => Document::$voter_id],$dd_data);
        }

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
