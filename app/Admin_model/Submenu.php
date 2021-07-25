<?php

namespace App\Admin_model;

use Illuminate\Database\Eloquent\Model;

class Submenu extends Model
{
    protected $fillable = [
        'index_no', 'mainmenu_id', 'submenu_name', 'submenu_route','status'
    ];

    public function user()
    {
        return $this->belongsToMany('App\User');

    }
}
