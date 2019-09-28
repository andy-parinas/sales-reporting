<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesReport extends Model
{
    protected $guarded = [];


    public function tourAgent()
    {
        return $this->belongsTo(TourAgent::class);
    }

    public function tourGuide()
    {
        return $this->belongsTo(TourGuide::class);
    }

    public function selectedProducts()
    {
        return $this->hasMany(SelectedProduct::class);
    }

    public function deduction()
    {
        return $this->hasOne(Deduction::class);
    }


}
