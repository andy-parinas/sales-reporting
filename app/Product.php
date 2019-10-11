<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Laravel\Scout\Searchable;

class Product extends Model
{
    // use Searchable;

    protected $fillable = [
        'name',
        'product_type_id',
        'description',
        'cost',
        'price'
    ];

    protected $with = ['productType'];

    public function productType()
    {
        return $this->belongsTo(ProductType::class);
    }

    public function selectedProducts()
    {
        return $this->hasMany(SelectedProduct::class);
    }

}
