<?php

namespace App\Http\Controllers;

use App\Models\JournalEntry;
use App\Http\Requests\StoreJournalEntryRequest;
use App\Http\Requests\UpdateJournalEntryRequest;
use App\Models\ApplicationForm;
use App\Models\Enquiry;
use App\Models\LedgerAccount;
use App\Models\LoanApplication;
use App\Models\Transaction;
use Illuminate\Http\Request;

class JournalEntryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page = $request->input('page', 1);
        $perPage = 100;
        $journal_entries = JournalEntry::paginate($perPage, ['*'], 'page', $page);
        foreach($journal_entries as $key =>$val){
            $val['ledger_account'] = LedgerAccount::find($val->ledger_id)->name;
            $val['loan_id'] = isset(LoanApplication::find($val->loan_id)->loan_id) ? LoanApplication::find($val->loan_id)->loan_id :'';
            $val['enquiry_id'] = isset(Enquiry::find($val->enquiry_id)->enquiry_id) ? Enquiry::find($val->enquiry_id)->enquiry_id :'';
        }
        return view('journal_entries.index',compact('journal_entries'));
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
     * @param  \App\Http\Requests\StoreJournalEntryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreJournalEntryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JournalEntry  $journalEntry
     * @return \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {
        $loan = LoanApplication::find($id);
        $page = $request->input('page', 1);
        $perPage = 100;
        $journal_entries = JournalEntry::paginate($perPage, ['*'], 'page', $page);
        foreach($journal_entries as $key =>$val){
            $val['ledger_account'] = LedgerAccount::find($val->ledger_id)->name;
        }
        return view('journal_entries.show',compact('journal_entries','loan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JournalEntry  $journalEntry
     * @return \Illuminate\Http\Response
     */
    public function edit(JournalEntry $journalEntry)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateJournalEntryRequest  $request
     * @param  \App\Models\JournalEntry  $journalEntry
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateJournalEntryRequest $request, JournalEntry $journalEntry)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JournalEntry  $journalEntry
     * @return \Illuminate\Http\Response
     */
    public function destroy(JournalEntry $journalEntry)
    {
        //
    }

    public function profitLoss(){
        $processing_fees = ApplicationForm::sum('processing_fees');
        $login_charge = Enquiry::sum('login_charge');
        $emi_interest = Transaction::sum('interest');
        $total = $processing_fees + $login_charge + $emi_interest;
        $data = [
            'processing_fees' => $processing_fees,
            'login_charge' => $login_charge,
            'emi_interest' => $emi_interest,
            'total' => $total
        ];
        return view('profit_loss.index',compact('data'));
    }

    public function balanceSheet(){
        return view('balance_sheet.index');
    }


}
