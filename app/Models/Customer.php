<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['enquiry_id','status','type','title','occupation','mobile','image','image','gender','first_name','last_name','last_name','dob','qualification','qualification','reference_mobile','father_name','mother_name','spouse_name','alternative_mobile','email','marital_status','yearly_income','relationship','address'];
    static $customer = 'customer';
}
