<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $fillable = ['customer_id','type','address','address_2','area','land_mark','city','state','pincode','country','district'];
    static $current_address = '1';
    static $permanent_address = '2';


}
