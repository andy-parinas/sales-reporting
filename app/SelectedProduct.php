<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SelectedProduct extends Model
{
    
    protected $fillable = [
        'product_id',
        'price',
        'cost',
        'quantity',
        'total'
    ];

    protected $with = ['product'];

    // public function getTotalAttribute($value)
    // {
    //     return number_format($value, 2, '.', ',');
    // }


    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
