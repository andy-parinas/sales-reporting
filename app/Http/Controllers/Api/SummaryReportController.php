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
        
    }


    public function store()
    {
        $data = request()->all();

        // dd($data);
        DB::beginTransaction();

        try {
            
            $summary = SummaryReport::create($data);

            $summary->summaryReportItems()->createMany($data['summary_items']);

            return response($summary, Response::HTTP_CREATED);

        } catch (Exception $e) {
            
            DB::rollBack();

            return response($e, Response::HTTP_BAD_REQUEST);
        }

    }

}
