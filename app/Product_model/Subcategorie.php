<?php

namespace App\Product_model;

use Illuminate\Database\Eloquent\Model;

class Subcategorie extends Model
{
    protected $fillable = [
        'category_id', 'subcategory_name', 'makeby',
    ];

    public function categorie()
    {
        return $this->belongsTo('App\Product_model\Categorie');
    }

    public function bikes(){
        return $this->hasOne('App\Bike_Model\Bike');
    }
}
