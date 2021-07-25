<?php

namespace App\Admin_model;

use Illuminate\Database\Eloquent\Model;

class Customerpayment extends Model
{
    protected $fillable = [
        'invoice_no','customer_id','showroom_id','pay_amount','payment_way','money_receipt','payment_date','make_by'
    ];
}


