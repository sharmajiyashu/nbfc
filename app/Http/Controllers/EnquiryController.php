<?php

namespace App\Http\Controllers;

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
    public function index()
    {
        $enquires = Enquiry::orderBy('id','desc')->get();
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
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'mobile' => 'required|digits:10|numeric',
            'address' => 'required',
            'address_2' => 'required',
            'city' => 'required|max:20',
            'pin_code' => 'required|max:10',
            'login_charge' => 'required|numeric',
            'aadhar_number' => 'nullable|max:16',
            'voder_id' => 'nullable|max:15',
            'pan_number' => 'nullable|max:10',
            'other_document' => 'nullable|max:20',
            'pay_mode' => 'required'
        ]);

        $validated['enquiry_id'] = self::GenerateId();

        $enquiry = Enquiry::create($validated);
        if(!empty($request->aadhar_number)){
            Document::create([
                'enquiry_id' => $enquiry->id,
                'type' => Document::$aadhar,
                'name' => 'Aadhar Number',
                'desc' => $request->aadhar_number,
                'image' => ''
            ]);
        }

        if(!empty($request->voder_id)){
            Document::create([
                'enquiry_id' => $enquiry->id,
                'type' => Document::$voder_id,
                'name' => 'Voter Id',
                'desc' => $request->voder_id,
                'image' => ''
            ]);
        }

        if(!empty($request->pan_number)){
            Document::create([
                'enquiry_id' => $enquiry->id,
                'type' => Document::$pan,
                'name' => 'Pan Number',
                'desc' => $request->pan_number,
                'image' => ''
            ]);
        }

        if(!empty($request->other_document)){
            Document::create([
                'enquiry_id' => $enquiry->id,
                'type' => Document::$other,
                'name' => 'Other Document',
                'desc' => $request->other_document,
                'image' => ''
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


}
