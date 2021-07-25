<?php

namespace App\Accounts_model;

use Illuminate\Database\Eloquent\Model;

class Recivecash extends Model
{
    protected $fillable = [
        'invoice_no','customer_id','showroom_id','received','received_date','user_id'
    ];

    public function customer(){
        return $this->belongsTo('App\Admin_model\Customer');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}

