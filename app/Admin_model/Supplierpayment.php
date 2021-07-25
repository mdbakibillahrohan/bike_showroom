<?php

namespace App\Admin_model;

use Illuminate\Database\Eloquent\Model;

class Supplierpayment extends Model
{
    protected $fillable = [
        'supplier_id','invoice_no', 'payment_date', 'pay_amount','payment_details','money_receipt','make_by','status','showroom_id'
    ];


}
