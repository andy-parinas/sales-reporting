<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SummaryReportItem extends Model
{
    protected $fillable = [
        'summary_report_id',
        'sales_report_id'
    ];

    protected $with = ['salesReport'];

    public function summaryReport()
    {
        return $this->belongsTo(SummaryReport::class);
    }

    public function salesReport()
    {
        return $this->belongsTo(SalesReport::class);
    }
}
