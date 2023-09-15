<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();
        static::creating (function ($model) {
            $model->transaction_id = Helper::generateTransaction();
        });
    }

    protected $fillable = ['loan_id','transaction_id','transaction_type','amount','interest','principal','penalty_amount','penalty_day','net_amount','comment','emi_count','emi_ids','payment_mode','payment_mode_dsc'];
    static $emi = '1';
}
