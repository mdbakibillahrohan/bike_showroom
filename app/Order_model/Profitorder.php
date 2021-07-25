<?php

namespace App\Order_model;

use Illuminate\Database\Eloquent\Model;

class Profitorder extends Model
{
    protected $fillable = [
        'invoice_no', 'product_id', 'purchase_id', 'showroom_id','buy_price','sell_price','quantity','total_buy_amount','total_sell_amount','selldate',
    ];

    public function product(){
        return $this->belongsTo('App\Product_model\Product');
    }
}



