<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    //
    protected $fillable = ['registration_id','quantity','payment_date','transfer_proof'];
}
