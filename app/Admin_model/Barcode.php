<?php

namespace App\Admin_model;

use Illuminate\Database\Eloquent\Model;

class Barcode extends Model
{
    protected $fillable = [
        'purchase_id','product_id','invoice_no','showroom_id','barcode','code_type'
    ];

    public function purchases(){
        return $this->belongsTo('App\Product_model\Purchase');
    }

    public function product(){
        return $this->belongsTo('App\Product_model\Product');
    }
}
