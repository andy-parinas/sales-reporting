<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];


    public function productType()
    {
        return $this->belongsTo(ProductType::class);
    }

}
