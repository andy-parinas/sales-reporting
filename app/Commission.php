<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    protected $fillable = [
        'name',
        'description'
    ];

    public function tourCommissions()
    {
        return $this->hasMany(TourCommission::class);
    }

    public function summaries()
    {
        return $this->hasMany(SummaryReport::class);
    }

}
