<?php

namespace App\Product_model;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = [
        'invoice_no','product_id','product_type', 'attribute', 'buy_price','quantity','sub_total_buy','buy_cost','discount','actual_buy','rest_qty','rest_buy_amount','sell_price','with_free','showroom_id','supplier_id','makeby','purchase_date','purchase_type','status',
    ];


    public function product(){
        return $this->belongsTo('App\Product_model\Product');
    }


//    public function products(){
//        return $this->hasMany('App\Product_model\Product');
//    }

    public function supplier(){
        return $this->belongsTo('App\Admin_model\Supplier');
    }

    public function barcodes()
    {
        return $this->hasMany('App\Admin_model\Barcode');
    }


}
