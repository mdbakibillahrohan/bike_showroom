<?php

namespace App\Admin_model;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'suplier_name', 'address', 'mobile', 'status','showroom_id'
    ];

    public function supplieraccount()
    {
        return $this->belongsTo('App\Admin_model\SupplierAccount');
    }

    public function purchases(){
        return $this->hasOne('App\Product_model\Purchase');
    }

    public function bikepurchases(){
        return $this->hasOne('App\Bike_Model\Bikepurchase');
    }
}
