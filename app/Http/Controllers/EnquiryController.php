<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Requests\StoreEnquiryRequest;
use App\Models\Document;
use App\Models\Enquiry;
use App\Models\JournalEntry;
use App\Models\LedgerAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EnquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page = $request->input('page',1);
        $enquires = Enquiry::orderBy('id','desc')->paginate(10, ['*'], 'page',$page);
        return view('enquires.index',compact('enquires'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('enquires.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEnquiryRequest $request)
    {
        try {
            DB::beginTransaction();
            $validated = $request->validated();
            $validated['enquiry_id'] = self::GenerateId();

            $enquiry = Enquiry::create($validated);

            if(!empty($request->aadhar_number)){
                Document::create([
                    'enquiry_id' => $enquiry->id,
                    'type' => Document::$aadhar,
                    'name' => 'Aadhar Number',
                    'desc' => $request->aadhar_number,
                    'image' => Helper::uploadDocument($request->aadhar_doc),
                ]);
            }

            if(!empty($request->voder_id)){
                Document::create([
                    'enquiry_id' => $enquiry->id,
                    'type' => Document::$voter_id,
                    'name' => 'Voter Id',
                    'desc' => $request->voder_id,
                    'image' => Helper::uploadDocument($request->voder_doc),
                ]);
            }

            if(!empty($request->pan_number)){
                Document::create([
                    'enquiry_id' => $enquiry->id,
                    'type' => Document::$pan,
                    'name' => 'Pan Number',
                    'desc' => $request->pan_number,
                    'image' => Helper::uploadDocument($request->pan_doc),
                ]);
            }

            if(!empty($request->other_document)){
                Document::create([
                    'enquiry_id' => $enquiry->id,
                    'type' => Document::$other,
                    'name' => 'Other Document',
                    'desc' => $request->other_document,
                    'image' => Helper::uploadDocument($request->other_doc),
                ]);
            }

            Helper::setDefaultGeneralAccount();
            $ledger_account = LedgerAccount::updateOrCreate(['enquiry_id' => $enquiry->id],[
                'enquiry_id' => $enquiry->id,
                'name' => $enquiry->first_name.' '.$enquiry->last_name,
            ]);

            $group = JournalEntry::count();
            JournalEntry::create([
                'group_id' => $group,
                'ledger_id' => LedgerAccount::$cash,
                'description' => 'with amount of log in charge ',
                'enquiry_id' => $enquiry->id,
                'amount' => $request->login_charge,
                'type' => 'dr'
            ]);

            JournalEntry::create([
                'group_id' => $group,
                'ledger_id' => LedgerAccount::$login_in_charge,
                'description' => 'with amount of log in charge',
                'enquiry_id' => $enquiry->id,
                'amount' => $request->login_charge,
                'type' => 'cr'
            ]);

            JournalEntry::create([
                'group_id' => $group,
                'ledger_id' => LedgerAccount::$login_in_charge,
                'description' => 'with amount of log in charge',
                'enquiry_id' => $enquiry->id,
                'amount' => $request->login_charge,
                'type' => 'dr'
            ]);

            JournalEntry::create([
                'group_id' => $group,
                'ledger_id' => LedgerAccount::$profit_and_loss,
                'description' => 'with amount of log in charge',
                'enquiry_id' => $enquiry->id,
                'amount' => $request->login_charge,
                'type' => 'cr'
            ]);
            DB::commit();
            return redirect()->route('enquires.index')->with('success','Enquiry create successfully');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error occurred: ' . $e->getMessage());
            return response()->json(['error' =>  $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Enquiry  $enquiry
     * @return \Illuminate\Http\Response
     */
    public function show(Enquiry $enquiry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Enquiry  $enquiry
     * @return \Illuminate\Http\Response
     */
    public function edit(Enquiry $enquiry)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Enquiry  $enquiry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Enquiry $enquiry)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Enquiry  $enquiry
     * @return \Illuminate\Http\Response
     */
    public function destroy(Enquiry $enquiry)
    {
        //
    }

    function GenerateId(){
        $store_code = 'ENQ'.mt_rand(10000000, 99999999);
        if(Enquiry::where('enquiry_id',$store_code)->first()){
            $this->GenerateId();
        }else{
            return $store_code;
        }
    }

    public function changeStatus(Request $request){
        Enquiry::where('id',$request->id)->update(['status' => $request->status ,'comment' => $request->comment]);
        return redirect()->back()->with('success','Status changed successfully');
    }

    public function loanApplicationApprovel(){
        
    }


}
