<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationForm extends Model
{
    use HasFactory;

    protected $fillable = ['emi_amount','enrollment_date','application_id','processing_fees','payment_mode','payment_mode_desc','loan_amount','loan_type','rate_of_interest','tenure','application_date','additional_charge','emi_amount','enquiry_id'];

    protected static function boot()
    {
        parent::boot();
        static::creating (function ($model) {
            // $model->slug = str_slug($model->title);
            $model->application_id = self::GenerateId();
        });
    }


    function GenerateId(){
        $store_code = 'APP'.mt_rand(10000000, 99999999);
        if(ApplicationForm::where('application_id',$store_code)->first()){
            $this->GenerateId();
        }else{
            return $store_code;
        }
    }
    
}
