<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesDeduction extends Model
{
    
    protected $fillable = [
        'deduction_id',
        'amount'
    ];

    protected $with = ['deduction'];


    public function getAmountAttribute($value)
    {
        return number_format($value, 2, '.', ',');
    }

    public function deduction()
    {
        return $this->belongsTo(Deduction::class);
    }
    
}
