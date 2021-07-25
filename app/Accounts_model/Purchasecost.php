<?php

namespace App\Accounts_model;

use Illuminate\Database\Eloquent\Model;

class Purchasecost extends Model
{
    protected $fillable=[
        'supplier_pay_id',
        'showroom_id',
        'cost_reson',
        'cost_amount',
        'date',
        'user_id',
    ];
}
