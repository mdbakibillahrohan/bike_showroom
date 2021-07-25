<?php

namespace App\Admin_model;

use Illuminate\Database\Eloquent\Model;

class CustomerAccount extends Model
{
    protected $fillable = [
        'customer_id', 'showroom_id', 'invoice_id', 'accounts','status'
    ];
}
