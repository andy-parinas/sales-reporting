<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TourAgent extends Model
{
    
    protected $guarded = [];


    public function tourGuides()
    {
        return $this->hasMany(TourGuide::class);
    }
}
