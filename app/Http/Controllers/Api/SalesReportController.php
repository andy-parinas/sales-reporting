<?php

namespace App\Http\Controllers\Api;

use App\Deduction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SalesReportRequest;
use App\SalesReport;
use App\SelectedProduct;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class SalesReportController extends Controller
{
    

    public function store(SalesReportRequest $request)
    {
        $reportData = $this->reportData($request);
        $deduction = $this->deductionData($request);


        DB::beginTransaction();
        try {
            
            $report = SalesReport::create($reportData);
            $report->deduction()->create($deduction);
            $report->selectedProducts()->createMany($request->validated()['selected_products']);
            $report->salesCommissions()->createMany($request->validated()['sales_commissions']);
        
            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
        }


    }


    private function reportData(SalesReportRequest $request)
    {

        return  [
            'report_number' => $request->validated()['report_number'],
            'grp_code' => $request->validated()['grp_code'],
            'adult_count' => $request->validated()['adult_count'],
            'children_count' => $request->validated()['children_count'],
            'tour_agent_id' => $request->validated()['tour_agent_id'],
            'tour_guide_id' => $request->validated()['tour_guide_id'],
            'tc_name' => $request->validated()['tc_name'],
            'total_sales' => $request->validated()['total_sales'],
            'total_agent_sales' => $request->validated()['total_agent_sales'],
            'total_commission' => $request->validated()['total_commission'],
            'gst' => $request->validated()['gst'],
            'grand_total_commission' => $request->validated()['grand_total_commission'],
        ];

    }

    private function deductionData(SalesReportRequest $request)
    {
        return [
            'guide_incentive' => $request->validated()['guide_incentive'],
            'delivery' => $request->validated()['delivery'],
            'service' => $request->validated()['service'],
            'total' => $request->validated()['total'],
        ];
    }

    
}
