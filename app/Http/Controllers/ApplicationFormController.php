<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Address;
use App\Models\ApplicationForm;
use App\Models\Customer;
use App\Models\Document;
use App\Models\Emi;
use App\Models\Enquiry;
use App\Models\LoanApplication;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

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
        self::uplodeKyc($customer->id,$request->only('aadhar_number','aadhar_doc','voter_id','voter_doc','pan_number','pan_doc',
        'ration_card_number','ration_card_doc','dl_number','dl_doc','bank_statement_number','bank_statement_doc','property_paper_number',
        'other_document_name','other_document_doc','property_paper_doc','cibil_score_doc','cibil_score_name','cheque_number','cheque_doc'));
        return redirect()->back()->with('success','Save Update success');
    }

    function uplodeKyc($customer_id,$data){
        if(!empty($data['cibil_score_name'])){
            $cibil_score_doc = Helper::uploadDocument(isset($data['cibil_score_doc']) ? $data['cibil_score_doc'] : null);
            $dd_data = [
                'customer_id' => $customer_id,
                'type' => Document::$cibil_score,
                'name' => 'Cibil Score',
                'desc' => isset($data['cibil_score_name']) ? $data['cibil_score_name'] :'',
            ];
            if($cibil_score_doc){
                $dd_data['image'] = $cibil_score_doc;
            }
            $document = Document::updateOrCreate(['customer_id' => $customer_id ,'type' => Document::$cibil_score],$dd_data);
        }

        if(!empty($data['cheque_number'])){
            $cheque_doc = Helper::uploadDocument(isset($data['cheque_doc']) ? $data['cheque_doc'] : null);
            $dd_data = [
                'customer_id' => $customer_id,
                'type' => Document::$cheque,
                'name' => 'Cheque',
                'desc' => isset($data['cheque_number']) ? $data['cheque_number'] :'',
            ];
            if($cheque_doc){
                $dd_data['image'] = $cheque_doc;
            }
            $document = Document::updateOrCreate(['customer_id' => $customer_id ,'type' => Document::$cheque],$dd_data);
        }

        
        if(!empty($data['other_document_name'])){

            // print_r($data['other_document_name']);die;
            $other_document_doc = Helper::uploadDocument(isset($data['other_document_doc']) ? $data['other_document_doc'] : null);
            $dd_data = [
                'customer_id' => $customer_id,
                'type' => Document::$other,
                'name' => 'Other Document',
                'desc' => isset($data['other_document_name']) ? $data['other_document_name'] :'',
            ];
            if($other_document_doc){
                $dd_data['image'] = $other_document_doc;
            }
            $document = Document::updateOrCreate(['customer_id' => $customer_id ,'type' => Document::$other],$dd_data);
        }

        

        if(!empty($data['property_paper_number'])){
            
            $property_paper_doc = Helper::uploadDocument(isset($data['property_paper_doc']) ? $data['property_paper_doc'] : null);
            $dd_data = [
                'customer_id' => $customer_id,
                'type' => Document::$property_type,
                'name' => 'Property Type',
                'desc' => isset($data['property_paper_number']) ? $data['property_paper_number'] :'',
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
                'desc' => isset($data['bank_statement_number']) ? $data['bank_statement_number'] :'',
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
                'desc' => isset($data['dl_number']) ? $data['dl_number'] :'',
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
                'desc' => isset($data['ration_card_number']) ? $data['ration_card_number'] :'',
                // 'image' => Helper::uploadDocument($data['ration_card_doc']),
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
                'desc' => isset($data['pan_number']) ? $data['pan_number'] :'',
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
                'desc' => isset($data['aadhar_number']) ? $data['aadhar_number'] :'',
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
                'desc' => isset($data['voter_id']) ? $data['voter_id'] : '',
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

    public function loanApplicationApprovel(Request $request){
        $page = $request->input('page', 1);
        $perPage = 10;
    
        // Use the query builder to build the query before calling paginate
        $query = ApplicationForm::where('status', ApplicationForm::$pending);
    
        $applications = $query->paginate($perPage, ['*'], 'page', $page)->map(function($item){
            $item->customer = Customer::select('first_name','last_name','mobile')->where('enquiry_id',$item->enquiry_id)->where('type',Customer::$customer)->first();
            $item->loan_type = Helper::getLoneName($item->loan_type);
            return $item;
        });
    
        // $applications->paginate($perPage, ['*'], 'page', $page);
    
        return view('application-forms.approve-application', compact('applications'));
    }

    public function approved(Request $request){
        $start_date = $request->start_date;
        $loan_amount = $request->loan_amount;
        $application = ApplicationForm::find($request->id);
        $getInterestAndPrinciple = Helper::getInterestAndPrinciple($request->loan_amount,$application->rate_of_interest,$application->tenure);
        $customer = Customer::where(['enquiry_id'=> $application->enquiry_id , 'type' => Customer::$customer])->first();
        $emi = $getInterestAndPrinciple['emi'];
        $loan = LoanApplication::updateOrCreate(['application_id' => $application->id],[
            'loan_type' => $application->loan_type,
            'application_id' => $application->id,
            'customer_id' => $customer->id,
            'additional_charge' => $application->additional_charge,
            'amount_requested' => $application->loan_amount,
            'loan_amount' => $loan_amount,
            'tenure' => $application->tenure,
            'emi' => isset($getInterestAndPrinciple['emi']) ? $getInterestAndPrinciple['emi'] :'',
            'interest_amount' => isset($getInterestAndPrinciple['total_interest_amount']) ? $getInterestAndPrinciple['total_interest_amount'] :'',
            'total_amount_paid' => isset($getInterestAndPrinciple['total_amount_paid']) ? $getInterestAndPrinciple['total_amount_paid'] :'',
            'rate_of_interest' => isset($getInterestAndPrinciple['rate_of_interest']) ? $getInterestAndPrinciple['rate_of_interest'] :'',
            'start_emi' => $start_date,
        ]);
        $data = Helper::showCalculation($request->loan_amount,$application->rate_of_interest,$start_date,$application->tenure,$emi);
        $loan_id = $loan->id;
        $emi_no = 1;
        foreach($data as $key=>$value){
            $loan = Emi::updateOrCreate(['loan_id' => $loan_id ,'emi_number' => $emi_no],[
                'loan_id' => $loan_id,
                'emi' => $value['emi'],
                'emi_number' => $emi_no,
                'interest' => $value['interest'],
                'principal' => $value['principal'],
                'emi_date' => $value['payement_date'],
                'due_amount' => $value['emi'],
            ]);
            $emi_no ++;
        }
        ApplicationForm::where('id',$request->id)->update(['status' => ApplicationForm::$approved]);
        return redirect()->back()->with('success','Approved success');
    }

    public function reject(Request $request){
        ApplicationForm::where('id',$request->id)->update(['status'=>ApplicationForm::$reject ,'reject_reason' => $request->reason]);
        return redirect()->back()->with('success','Reject success');
    }

}
