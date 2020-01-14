<?php

namespace App\Http\Controllers;

use App\SalesReport;
use App\SummaryReport;
use App\SummaryReportItem;
use Illuminate\Http\Request;

class SummaryReportController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('summaries.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('summaries.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Using API for Store
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SummaryReport  $summaryReport
     * @return \Illuminate\Http\Response
     */
    public function show(SummaryReport $summary)
    {
        $selected_commission = $summary->selectedCommission;
        $items = $summary->summaryReportItems;
        
        // dd(compact('summary', 'items', 'selected_commission'));

        return view('summaries.show', compact('summary', 'items', 'selected_commission'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SummaryReport  $summaryReport
     * @return \Illuminate\Http\Response
     */
    public function edit(SummaryReport $summary)
    {
        $items = $summary->summaryReportItems;
        // $items = "none";

        // $items = SummaryReportItem::with('salesReport')->where('summary_report_id', '=', $summary->id)->get();

        // dd(compact('summary', 'items'));
        // dd($items[0]->salesReport);

        return view('summaries.edit', compact('summary', 'items'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SummaryReport  $summaryReport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SummaryReport $summaryReport)
    {
        //Using API for update
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SummaryReport  $summaryReport
     * @return \Illuminate\Http\Response
     */
    public function destroy(SummaryReport $summaryReport)
    {
        //
    }
}
