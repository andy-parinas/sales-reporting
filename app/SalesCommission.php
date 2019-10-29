<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesCommission extends Model
{
    protected $fillable = [
        'tour_commission_id',
        'amount'
    ];

    protected $with = ['tourCommission'];


    public function tourCommission()
    {
        return $this->belongsTo(TourCommission::class);
    }
    
}
