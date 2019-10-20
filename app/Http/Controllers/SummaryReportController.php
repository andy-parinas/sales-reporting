<?php

namespace App\Http\Controllers;

use App\SummaryReport;
use Illuminate\Http\Request;

class SummaryReportController extends Controller
{
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SummaryReport  $summaryReport
     * @return \Illuminate\Http\Response
     */
    public function show(SummaryReport $summaryReport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SummaryReport  $summaryReport
     * @return \Illuminate\Http\Response
     */
    public function edit(SummaryReport $summaryReport)
    {
        //
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
        //
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
