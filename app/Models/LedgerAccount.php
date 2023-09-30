<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LedgerAccount extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['name','type','loan_id','status','enquiry_id'];

    static $cash = 1;
    static $emi_interest = 2;
    static $login_in_charge = 3;
    static $processing_fees = 4;
    static $profit_and_loss = 5;
    static $additional_charge = 6;
    static $penalty_amount = 7;

}
