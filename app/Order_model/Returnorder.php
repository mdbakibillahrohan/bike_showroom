<?php

namespace App\Order_model;

use Illuminate\Database\Eloquent\Model;

class Returnorder extends Model
{
    protected $fillable = [
        'order_id', 'return_invoice', 'sell_invoice', 'customer_id','product_id','showroom_id','sellprice','quantity','amount','deducted','return_cash','return_status','date','user_id',
    ];

    public function product()
    {
        return $this->belongsTo('App\Product_model\Product');
    }

    public function customer()
    {
        return $this->belongsTo('App\Admin_model\Customer');
    }
}


