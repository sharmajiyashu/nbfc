<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\ApplicationForm;
use App\Models\Customer;
use App\Models\Document;
use App\Models\Emi;
use App\Models\EmiTransaction;
use App\Models\Enquiry;
use App\Models\JournalEntry;
use App\Models\LedgerAccount;
use App\Models\LoanApplication;
use App\Models\Transaction;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    function reset(){
        LedgerAccount::truncate();
        Customer::truncate();
        ApplicationForm::truncate();
        LoanApplication::truncate();
        Enquiry::truncate();
        JournalEntry::truncate();
        Transaction::truncate();
        Emi::truncate();
        EmiTransaction::truncate();
        Address::truncate();
        Document::truncate();
        return redirect()->back()->with('success','Reset All Successfully');
    }
}
