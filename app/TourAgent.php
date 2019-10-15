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


    public function tourGuides()
    {
        return $this->hasMany(TourGuide::class);
    }
}
