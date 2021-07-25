<?php

namespace App\Bike_Model;

use Illuminate\Database\Eloquent\Model;

class Bikepurchase extends Model
{

    protected $fillable = [
        'supplier_id', 'date', 'invoice', 'bike_id', 'quantity', 'rest_qty', 'buy_price', 'commission', 'sell_price', 'discount_price', 'offer', 'gift_product', 'showroom_id', 'user_id'
    ];


    public function bike(){
        return $this->belongsTo('App\Bike_Model\Bike');
    }

    public function supplier(){
        return $this->belongsTo('App\Admin_model\Supplier');
    }

}
