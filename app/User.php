<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'mobile', 'role_id', 'image', 'status', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function showrooms(){
        return $this->belongsToMany('App\Showroom_model\Showroom');
    }

    public function orders(){
        return $this->belongsToMany('App\Order_model\Order');
    }
    public function recivecash(){
        return $this->hasMany('App\Accounts_model\Recivecash');
    }
    public function bikes(){
        return $this->belongsTo('App\Bike_Model\Bike');
    }

    public function bikesells(){
        return $this->hasOne('App\Bike_Model\Bikesell');
    }

    public function menudata()
    {
        return $this->belongsToMany('App\Admin_model\Submenu');

    }
}
