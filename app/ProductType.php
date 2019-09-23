<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    protected $guarded = [];


    public function products()
    {
        $this->hasMany(Product::class);
    }
}
