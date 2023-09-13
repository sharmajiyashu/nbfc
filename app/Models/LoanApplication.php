<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LoanApplication extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['application_id','loan_type','customer_id','additional_charge','amount_requested','loan_amount','tenure','emi','interest_amount','total_amount_paid','rate_of_interest','start_emi','status'];

}
