<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = ['enquiry_id','type','name','desc','image'];

    static $aadhar = 'aadhar';
    static $voder_id = 'voder_id';
    static $pan = 'pan';
    static $other = 'other';
}
