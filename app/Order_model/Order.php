<?php

namespace App\Order_model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'invoice_no','customer_id','showroom_id','product_id','category_id','sub_category','brand_id','product_code','sellprice','quantity','total_sellprice','sell_discount','sell_cost','lastsell_amount','vat','attribute','return_cash','return_invoice','selldate','user_id','warranty','status','product_details'
    ];

    public function customer()
    {
        return $this->belongsTo('App\Admin_model\Customer');
    }

    public function product()
    {
        return $this->belongsTo('App\Product_model\Product');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
