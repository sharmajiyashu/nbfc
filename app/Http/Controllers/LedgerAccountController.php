<?php

namespace App\Http\Controllers;

use App\Models\LedgerAccount;
use App\Http\Requests\StoreLedgerAccountRequest;
use App\Http\Requests\UpdateLedgerAccountRequest;
use App\Models\Enquiry;
use App\Models\JournalEntry;
use App\Models\LoanApplication;
use Illuminate\Http\Request;

class LedgerAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page = $request->input('page',1);
        $ledgers = LedgerAccount::where('status',1)->paginate(10, ['*'], 'page',$page);
        foreach($ledgers as $key => $val){
            $val['total_dr'] = JournalEntry::where('ledger_id',$val->id)->where('type','dr')->sum('amount');
            $val['total_cr'] = JournalEntry::where('ledger_id',$val->id)->where('type','cr')->sum('amount');
        }
        return view('ledgers.index',compact('ledgers'));
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
     * @param  \App\Http\Requests\StoreLedgerAccountRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLedgerAccountRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LedgerAccount  $ledgerAccount
     * @return \Illuminate\Http\Response
     */
    public function show(LedgerAccount $ledgerAccount,$id ,Request $request)
    {
        $page = $request->input('page',1);
        $data = [];
        $journal_entries = JournalEntry::where('ledger_id',$id)->paginate(10, ['*'], 'page',$page);
        foreach($journal_entries as $key =>$val){
            if($val->type == 'dr'){
                $data[] = $val;
                $data[] = JournalEntry::where('id',$val->id + 1)->first();
            }else{
                
                $data[] = JournalEntry::where('id',$val->id - 1)->first();
                $data[] = $val;
            }
        }

        foreach($data as $key =>$val){
            $val['ledger_account'] = LedgerAccount::find($val->ledger_id)->name;
            $val['loan_id'] = isset(LoanApplication::find($val->loan_id)->loan_id) ? LoanApplication::find($val->loan_id)->loan_id :'';
            $val['enquiry_id'] = isset(Enquiry::find($val->enquiry_id)->enquiry_id) ? Enquiry::find($val->enquiry_id)->enquiry_id :'';
        }
        $ledgers = LedgerAccount::find($id);
        return view('ledgers.show',compact('journal_entries','data','ledgers'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LedgerAccount  $ledgerAccount
     * @return \Illuminate\Http\Response
     */
    public function edit(LedgerAccount $ledgerAccount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLedgerAccountRequest  $request
     * @param  \App\Models\LedgerAccount  $ledgerAccount
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLedgerAccountRequest $request, LedgerAccount $ledgerAccount)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LedgerAccount  $ledgerAccount
     * @return \Illuminate\Http\Response
     */
    public function destroy(LedgerAccount $ledgerAccount)
    {
        //
    }
}
