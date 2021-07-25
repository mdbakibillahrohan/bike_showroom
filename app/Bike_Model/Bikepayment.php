<?php

namespace App\Bike_Model;

use Illuminate\Database\Eloquent\Model;

class Bikepayment extends Model
{
    protected $fillable = [
        'payment_date', 'payment_type', 'bikecustomer_id', 'bike_id', 'Pay_amount', 'bankdetails', 'carddetails', 'mobilebankdetails', 'user_id'
    ];


    public function bikecustomer(){
        return $this->belongsTo('App\Bike_Model\Bikecustomer');
    }

    public function bike(){
        return $this->belongsTo('App\Bike_Model\Bike');
    }

}


