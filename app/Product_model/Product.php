<?php

namespace App\Product_model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'id','product_name', 'product_deatils', 'categorie_id','subcategorie_id','brand_id','sell_type','big_unit_relation','small_unit_relation','showroom_id','status',
    ];

    public function categorie()
    {
        return $this->belongsTo('App\Product_model\Categorie');
    }

    public function brand(){
        return $this->belongsTo('App\Product_model\Brand');
    }


    public function purchases(){
        return $this->hasMany('App\Product_model\Purchase');
    }

    public function product_barcodes()
    {
        return $this->hasMany('App\Admin_model\Barcode');
    }

    public function orders(){
        return $this->belongsToMany('App\Order_model\Order');
    }

    public function profitorder(){
        return $this->hasMany('App\Order_model\Profitorder');
    }

    public function returnorders(){
        return $this->hasMany('App\Order_model\Returnorder');
    }
}
