<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Emi extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['loan_id','emi_number','emi','due_amount','interest','principal','status','partial_date','emi_date'];

}
