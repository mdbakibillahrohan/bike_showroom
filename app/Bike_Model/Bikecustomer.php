<?php

namespace App\Bike_Model;

use Illuminate\Database\Eloquent\Model;

class Bikecustomer extends Model
{
    protected $fillable = [
        'bikesell_id', 'customer_name', 'guardian_name', 'address', 'mobile','guarantorname','guarantor_address','guarantor_mobile','customer_image','national_id','electric_bill','other_image','payment_type'
    ];

    public function bikesells(){
        return $this->hasOne('App\Bike_Model\Bikesell');
    }

    public function installments(){
        return $this->hasOne('App\Bike_Model\Installment');
    }

    public function bikepayments(){
        return $this->hasOne('App\Bike_Model\Bikepayment');
    }

}
