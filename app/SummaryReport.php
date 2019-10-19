<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SummaryReport extends Model
{
    protected $fillable = [
        'report_number',
        'adult_count_total',
        'children_count_total',
        'sales_total',
        'agent_commissions_total',
        'gst_total',
        'total',
        'return',
        'duvet_deduction',
        'balance'
    ];


    public function summaryReportItems()
    {
        return $this->hasMany(SummaryReportItem::class);
    }
}