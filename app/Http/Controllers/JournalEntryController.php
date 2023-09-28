<?php

namespace App\Http\Controllers;

use App\Models\JournalEntry;
use App\Http\Requests\StoreJournalEntryRequest;
use App\Http\Requests\UpdateJournalEntryRequest;
use App\Models\LedgerAccount;
use App\Models\LoanApplication;
use Illuminate\Http\Request;

class JournalEntryController extends Controller
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
        return view('journal_entries.index',compact('journal_entries','loan'));
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
        return view('profit_loss.index');
    }

    public function balanceSheet(){
        return view('balance_sheet.index');
    }


}
