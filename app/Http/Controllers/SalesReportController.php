<?php

namespace App\Http\Controllers;

use App\SalesReport;
use Illuminate\Http\Request;

class SalesReportController extends Controller
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
        
        return view('sales.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sales.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return redirect('/sales');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SalesReport  $salesReport
     * @return \Illuminate\Http\Response
     */
    public function show(SalesReport $sale)
    {

        $selectedProducts = $sale->selectedProducts;
        $deductions = $sale->deductions;
        $commissions = $sale->commissions;

        // foreach ($selectedProducts as $product) {
        //     dump($product->product->name);
        // }


        return view('sales.show', compact('sale', 'selectedProducts', 'deductions', 'commissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SalesReport  $salesReport
     * @return \Illuminate\Http\Response
     */
    public function edit(SalesReport $salesReport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SalesReport  $salesReport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SalesReport $salesReport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SalesReport  $salesReport
     * @return \Illuminate\Http\Response
     */
    public function destroy(SalesReport $salesReport)
    {
        //
    }
}
