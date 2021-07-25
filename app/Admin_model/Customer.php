<?php

namespace App\Admin_model;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'customer_name','address','mobile','showroom_id','flag'
    ];

    public function orders(){
        return $this->belongsToMany('App\Order_model\Order');
    }

    public function recivecash(){
        return $this->hasMany('App\Accounts_model\Recivecash');
    }

    public function returnorders(){
        return $this->hasMany('App\Order_model\Returnorder');
    }

}
