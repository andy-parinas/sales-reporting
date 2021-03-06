<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TourGuide extends Model
{
    
    protected $fillable = [
        'name',
        'email',
        'phone'
    ];


    public function reports()
    {
        return $this->morphMany(SummaryReport::class, 'reportable');
    }

}
