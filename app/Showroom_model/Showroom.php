<?php

namespace App\Showroom_model;

use Illuminate\Database\Eloquent\Model;

class Showroom extends Model
{
    protected $fillable = [
        'showroom_name','address','mobile','showroom_details','expired_date','showroom_image','slag'
    ];

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function expences()
    {
        return $this->hasMany('App\Showroom_model\Expence');
    }
}
