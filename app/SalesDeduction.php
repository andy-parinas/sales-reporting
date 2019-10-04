<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesDeduction extends Model
{
    
    protected $fillable = [
        'deduction_id',
        'amount'
    ];


    
}
