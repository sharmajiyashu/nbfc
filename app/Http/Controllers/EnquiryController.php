<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Requests\StoreEnquiryRequest;
use App\Models\Document;
use App\Models\Enquiry;
use Illuminate\Http\Request;

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

        return redirect()->route('enquires.index')->with('success','Enquiry create successfully');



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
