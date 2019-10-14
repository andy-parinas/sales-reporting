<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesReport extends Model
{
    protected $guarded = [];


    // public function getTotalSalesAttribute($value)
    // {
    //     return number_format($value, 2, '.', ',');
    // }

    // public function getTotalAgentSalesAttribute($value)
    // {
    //     return number_format($value, 2, '.', ',');
    // }

    // public function getTotalCommissionsAttribute($value)
    // {
    //     return number_format($value, 2, '.', ',');
    // }

    // public function getTotalDeductionsAttribute($value)
    // {
    //     return number_format($value, 2, '.', ',');
    // }

    // public function getGrandTotalCommissionAttribute($value)
    // {
    //     return number_format($value, 2, '.', ',');
    // }

    // public function getGstAttribute($value)
    // {
    //     return number_format($value, 2, '.', ',');
    // }


    

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

    public function salesDeductions()
    {
        return $this->hasMany(SalesDeduction::class);
    }

    public function salesCommissions()
    {
        return $this->hasMany(SalesCommission::class);
    }

}
