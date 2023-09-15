<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmiTransaction extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['principal','interest','amount','emi_id','loan_id'];
}
