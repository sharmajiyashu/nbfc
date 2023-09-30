<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JournalEntry extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['ledger_id','description','type','group_id','loan_id','amount','enquiry_id'];

}
