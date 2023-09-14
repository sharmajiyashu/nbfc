<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LoanApplication extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['loan_id','application_id','loan_type','customer_id','additional_charge','amount_requested','loan_amount','tenure','emi','interest_amount','total_amount_paid','rate_of_interest','start_emi','status'];

    protected static function boot()
    {
        parent::boot();
        static::creating (function ($model) {
            $model->loan_id = Helper::generateLoanId($model->loan_type);
        });
    }
}
