<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SummaryReport;
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

    public function store()
    {
        $data = request()->all();

        // dd($data);
        DB::beginTransaction();

        try {
            
            $summary = SummaryReport::create($data);

            $summary->summaryReportItems()->createMany($data['summary_items']);

            DB::commit();

            return response($summary, Response::HTTP_CREATED);

        } catch (Exception $e) {
            
            DB::rollBack();

            return response($e, Response::HTTP_BAD_REQUEST);
        }

    }

}
