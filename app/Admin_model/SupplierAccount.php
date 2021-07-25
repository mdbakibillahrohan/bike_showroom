<?php

namespace App\Admin_model;

use Illuminate\Database\Eloquent\Model;

class SupplierAccount extends Model
{
    protected $fillable = [
        'supplier_id', 'showroom_id', 'invoice_id', 'accounts','status'
    ];

    public function supplier(){
        return $this->hasOne('App\Admin_model\Supplier');
    }
}
