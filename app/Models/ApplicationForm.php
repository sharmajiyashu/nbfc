<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationForm extends Model
{
    use HasFactory;

    protected $fillable = ['emi_amount','enrollment_date','application_id','processing_fees','payment_mode','payment_mode_desc','loan_amount','loan_type','rate_of_interest','tenure','application_date','additional_charge','emi_amount','enquiry_id','reject_reason'];

    protected static function boot()
    {
        parent::boot();
        static::creating (function ($model) {
            $model->application_id = Helper::generateApplicationId();
        });
    }

    static $pending = 0;
    static $approved = 1;
    static $reject = 2;
    
}
