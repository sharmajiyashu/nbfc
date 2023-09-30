<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JournalEntry extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['ledger_id','description','type','group_id','loan_id','amount','enquiry_id'];


    protected static function boot()
    {
        parent::boot();
        static::creating (function ($model) {
            if($model->loan_id){
                $model->enquiry_id = Helper::getEnquirybyLoanId($model->loan_id);
            }
        });
    }


}
