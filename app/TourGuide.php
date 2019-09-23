<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TourGuide extends Model
{
    
    protected $guarded = [];


    public function tourAgent()
    {
        return $this->belongsTo(TourAgent::class);
    }
}
