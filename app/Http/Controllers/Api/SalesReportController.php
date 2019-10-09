<?php

namespace App\Http\Controllers\Api;

use App\Deduction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SalesReportRequest;
use App\Http\Resources\SalesReportListResource;
use App\SalesCommission;
use App\SalesDeduction;
use App\SalesReport;
use App\SelectedProduct;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class SalesReportController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {

        return SalesReportListResource::collection(SalesReport::paginate(10));
    }
    

    public function store(SalesReportRequest $request)
    {
        $reportData = $this->reportData($request);

        DB::beginTransaction();
        try {
            
            $report = SalesReport::create($reportData);
            $report->salesDeductions()->createMany($request->validated()['sales_deductions']);
            $report->selectedProducts()->createMany($request->validated()['selected_products']);
            $report->salesCommissions()->createMany($request->validated()['sales_commissions']);
        
            DB::commit();

            return response($report, Response::HTTP_CREATED);

        } catch (\Exception $e) {
            DB::rollBack();

            return response(["error" => $e ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }


    }

    public function update(SalesReportRequest $request, SalesReport $sale)
    {

        $updateddata = $this->reportData($request);

        DB::beginTransaction();

        try {
            
            $sale->update($updateddata);

            foreach ($request->validated()['sales_deductions'] as $deduction) {
               
                $salesDeduction = SalesDeduction::find($deduction['id']);

                $salesDeduction->amount = $deduction['amount'];

                $salesDeduction->save();

            }

            foreach ($request->validated()['sales_commissions'] as $commission) {
               
                $salesCommission = SalesCommission::find($commission['id']);

                $salesCommission->amount = $commission['amount'];

                $salesCommission->save();

            }

            /**
             * For Selected Product, it is hard to determine if 
             * new selection was added or deleted. Best approach would be to
             * Delete all the selected products and create a new one.
             */
            $sale->selectedProducts->each(function($selected){
                $selected->delete();
            });

            $sale->selectedProducts()->createMany($request->validated()['selected_products']);
            

            DB::commit();

            return response($sale, Response::HTTP_OK);

        } catch (Exception $e) {
            
            DB::rollBack();

            return response(["error" => $e ], Response::HTTP_INTERNAL_SERVER_ERROR);

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
            'tour_date' => $request->validated()['tour_date'],
            'total_sales' => $request->validated()['total_sales'],
            'total_agent_sales' => $request->validated()['total_agent_sales'],
            'total_commissions' => $request->validated()['total_commissions'],
            'total_deductions' => $request->validated()['total_deductions'],
            'gst' => $request->validated()['gst'],
            'grand_total_commission' => $request->validated()['grand_total_commission'],
        ];

    }


    
}
