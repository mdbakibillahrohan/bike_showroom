<?php

namespace App\Bike_Model;

use Illuminate\Database\Eloquent\Model;

class Installment extends Model
{
    protected $fillable = [
        'payment_date', 'bikecustomer_id', 'bike_id', 'installment_no', 'installment_amount','install_paydate','pay_amount','interest','blanch','status'
    ];

    public function bikecustomer(){
        return $this->belongsTo('App\Bike_Model\Bikecustomer');
    }


}
