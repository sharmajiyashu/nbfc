<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    use HasFactory;

    protected $fillable = ['first_name','last_name','mobile','address','address_2','address_2','login_charge','pay_mode','pay_mode_desc','comment','status','pin_code','enquiry_id'];
}
