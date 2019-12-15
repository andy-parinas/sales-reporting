<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TourAgent extends Model
{
    
    protected $fillable = [
        'name',
        'address',
        'email',
        'phone'
    ];


    public function tourCommissions()
    {
        return $this->hasMany(TourCommission::class);
    }

    public function reports()
    {
        return $this->morphMany(SummaryReport::class, 'reportable');
    }

}
