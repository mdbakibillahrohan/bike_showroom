<?php

namespace App\Bike_model;

use Illuminate\Database\Eloquent\Model;

class Bikeidentity extends Model
{
    protected $fillable = [
        'bike_id', 'engine_no', 'chassis_no'
    ];



}
