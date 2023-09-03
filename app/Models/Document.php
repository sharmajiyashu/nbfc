<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = ['enquiry_id','type','name','desc','image','customer_id'];

    static $aadhar = 'aadhar';
    static $voter_id = 'voter_id';
    static $pan = 'pan';
    static $other = 'other';
    static $ration_card = 'ration_card';
    static $dl = 'dl';
    static $bank_statement = 'bank_statement';
    static $property_type = 'property_type';
}
