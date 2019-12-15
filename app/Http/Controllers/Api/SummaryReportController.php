<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SummaryReport;
use App\TourAgent;
use App\TourGuide;
use Exception;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class SummaryReportController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth:api');
    }


    public function index(Request $request)
    {
        if(($request->has('sort') && $request->has('direction')) || $request->has('search')){

            $query = DB::table('summary_reports')->select('*');

            if($request->has('search')){
                $query->where('report_number', 'like', '%' . $request['search'] . '%');
            }

            if($request->has('sort') && $request->has('direction')){
                $query->orderBy($request['sort'], $request['direction']);
            }else{
                $query->orderBy('report_number', 'desc');
            }

            return $query->paginate(10);



        }else {

            return DB::table('summary_reports')->select('*')
                ->orderBy('report_number', 'desc')
                ->paginate(10);
        }

        
    }

    public function store(Request $request)
    {
        $data = $this->validateSummaryData();
        $reportable = null;

        if($request->has('reportable') && $request->has('id')){

            if($request['reportable'] == 'AGENT'){
                $reportable = TourAgent::find($request['id']);
            }

            if($request['reportable'] == 'GUIDE'){
                $reportable = TourGuide::find($request['id']);
            }

        }

        if($reportable == null){
            return response(['error' => 'Agent or Guide not found'], Response::HTTP_NOT_FOUND);
        }



        DB::beginTransaction();

        try {
            
            // $summary = SummaryReport::create($data);
            $summary = $reportable->reports()->create($data);

            $summary->summaryReportItems()->createMany(request('summary_items'));

            DB::commit();

            return response($summary, Response::HTTP_CREATED);

        } catch (Exception $e) {
            
            DB::rollBack();

            return response($e, Response::HTTP_BAD_REQUEST);
        }

    }


    public function destroy(SummaryReport $summary)
    {
        $summary->delete();

        return response([], Response::HTTP_OK);
    }


    public function update(SummaryReport $summary)
    {
        $summary->update($this->validateSummaryData());

        return response($summary, Response::HTTP_OK);
    }

    private function validateSummaryData()
    {
        return request()->validate([
            'title' => 'required',
            'report_number'=> 'required',
            'from_date'=> 'required',
            'to_date'=> 'required',
            'adult_count_total'=> 'required',
            'children_count_total'=> 'required',
            'tc_count'=> 'required',
            'sales_total'=> 'required',
            'agent_commissions_total'=> 'required',
            'gst_total'=> 'required',
            'total'=> 'required',
            'return'=> '',
            'duvet_deduction'=> '',
            'balance'=> 'required'
        ]);
    }

}
