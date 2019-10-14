<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesCommission extends Model
{
    protected $fillable = [
        'commission_id',
        'amount'
    ];

    protected $with = ['commission'];

    // public function getAmountAttribute($value)
    // {
    //     return number_format($value, 2, '.', ',');
    // }

    public function commission()
    {
        return $this->belongsTo(Commission::class);
    }
    
}
