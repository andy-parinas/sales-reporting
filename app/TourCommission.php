<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TourCommission extends Model
{
    
    protected $fillable = [
        'tour_agent_id',
        'tour_type_id',
        'commission_type_id',
        'commision_id',
        'amount'
    ];

    protected $with = ['commission'];


    public function tourAgent()
    {
        return $this->belongsTo(TourAgent::class);
    }

    public function tourType()
    {
        return $this->belongsTo(TourType::class);
    }

    public function commissionType()
    {
        return $this->belongsTo(CommissionType::class);
    }

    public function commission()
    {
        return $this->belongsTo(Commission::class);
    }



}
