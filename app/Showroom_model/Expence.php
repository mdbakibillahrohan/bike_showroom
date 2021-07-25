<?php

namespace App\Showroom_model;

use Illuminate\Database\Eloquent\Model;

class Expence extends Model
{
    protected $fillable = [
        'date','showroom_id','expense_reason','expense_details','expense_amount','user_id'
    ];

    public function showroom()
    {
        return $this->belongsTo('App\Showroom_model\Showroom');
    }




}
