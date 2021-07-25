<?php

namespace App\Accounts_model;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'user_type'
    ];
}
