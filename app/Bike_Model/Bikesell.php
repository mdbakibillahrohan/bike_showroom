<?php

namespace App\Bike_Model;

use Illuminate\Database\Eloquent\Model;

class Bikesell extends Model
{
    protected $fillable = [
        'invoice', 'date', 'bikecustomer_id', 'bike_id', 'engine_no','ChassisNo','paymentway','bikedetails','bikesell_type','sell_price','quantity','discount','last_total_amount','cashpayment','due_amount','interest','last_due_amount','onetime_payment_date','installmentno','installmentamount','installment_start_date', 'user_id'
    ];


    public function bike(){
        return $this->belongsTo('App\Bike_Model\Bike');
    }

    public function bikecustomer(){
        return $this->belongsTo('App\Bike_Model\Bikecustomer');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }




}
