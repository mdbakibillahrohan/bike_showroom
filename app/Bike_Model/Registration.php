<?php

namespace App\Bike_Model;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $fillable = [
         'bikecustomer_id', 'bike_id', 'registrationtype', 'vatamount','registrationamount','total_amount','payment','due_amount','delivery_date','status'
    ];

    public function bike(){
        return $this->belongsTo('App\Bike_Model\Bike');
    }
}








