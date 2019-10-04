<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesCommission extends Model
{
    protected $fillable = [
        'commission_id',
        'amount'
    ];

    
}
