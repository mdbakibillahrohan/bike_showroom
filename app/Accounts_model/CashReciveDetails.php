<?php

namespace App\Accounts_model;

use Illuminate\Database\Eloquent\Model;

class CashReciveDetails extends Model
{
    protected $fillable = [
        'invoice_id','note_input','return_show', 'cardname', 'cardno','bkash','bankname','chequeno','date'
    ];









}
