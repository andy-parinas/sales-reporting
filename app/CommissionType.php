<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommissionType extends Model
{
    protected $fillable = [
        'name',
        'code'
    ];
    
}
