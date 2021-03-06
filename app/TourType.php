<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TourType extends Model
{
    
    protected $fillable = [
        'name',
        'description'
    ];


    public function tourCommissions()
    {
        return $this->hasMany(TourCommission::class);
    }
    
}
