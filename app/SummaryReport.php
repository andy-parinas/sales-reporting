<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SummaryReport extends Model
{
    protected $fillable = [
        'title',
        'report_number',
        'from_date',
        'to_date',
        'adult_count_total',
        'children_count_total',
        'tc_count',
        'sales_total',
        // 'agent_commissions_total',
        // 'gst_total',
        // 'total',
        // 'return',
        // 'duvet_deduction',
        // 'balance',
        'reportable_id',
        'reportable_type',
        'commission',
        'commission_id'
    ];


    public function summaryReportItems()
    {
        return $this->hasMany(SummaryReportItem::class);
    }

    

    public function reportable()
    {
        return $this->morphTo();
    }

    public function selectedCommission()
    {
        return $this->belongsTo(Commission::class, 'commission_id');
    }


}