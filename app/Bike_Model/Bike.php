<?php

namespace App\Bike_Model;

use Illuminate\Database\Eloquent\Model;

class Bike extends Model
{
    protected $fillable = [
        'name', 'model', 'details','categorie_id','subcategorie_id','brand_id','user_id','showroom_id'
    ];


    public function subcategorie(){
        return $this->belongsTo('App\Product_model\Subcategorie');
    }

    public function categorie(){
        return $this->belongsTo('App\Product_model\Categorie');
    }

    public function brand(){
        return $this->belongsTo('App\Product_model\Brand');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }


    public function bikepurchases(){
        return $this->hasOne('App\Bike_Model\Bikepurchase');
    }

    public function bikesells(){
        return $this->hasOne('App\Bike_Model\Bikesell');
    }

    public function installments(){
        return $this->hasOne('App\Bike_Model\Installment');
    }

    public function bikepayments(){
        return $this->hasOne('App\Bike_Model\Bikepayment');
    }

    public function registrations(){
        return $this->hasOne('App\Bike_Model\Registration');
    }


}
