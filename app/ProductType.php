<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    protected $fillable = [
        'name',
        'code'
    ];


    public function products()
    {
        $this->hasMany(Product::class);
    }
}
