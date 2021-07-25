<?php

namespace App\Product_model;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = [
        'brand_name', 'brand_image', 'showroom_id', 'makeby',
    ];

    public function products(){
        return $this->hasOne('App\Product_model\Product');
    }
    public function purchases(){
        return $this->hasMany('App\Product_model\Purchase');
    }

    public function bikes(){
        return $this->hasOne('App\Bike_Model\Bike');
    }
}
