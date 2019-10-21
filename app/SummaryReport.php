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