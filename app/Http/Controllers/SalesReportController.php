<?php

namespace App\Http\Controllers;

use App\Commission;
use App\CommissionType;
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

        // dd($sale->salesCommissions);
        $commissionTypes = CommissionType::all();
        $commissions = Commission::all();

     
        $selectedProducts = $sale->selectedProducts;
        $salesDeductions = $sale->salesDeductions;
        $salesCommissions = $sale->salesCommissions;

        $totalByCommissions = array();

        foreach ($commissions as $commission) {
            $total = 0;

            foreach ($salesCommissions as $salesCommission) {
                if($salesCommission->tourCommission->commission->id == $commission->id){
                    $total = $total + $salesCommission->amount;
                }
           }

           $totalByCommissions[$commission->name] = $total;

        //    array_push($totalByCommissions, $commission->name => $total);
        }

        // dd($totalByCommissions);

        return view('sales.show', compact('sale', 'commissionTypes', 'totalByCommissions', 'selectedProducts', 'salesDeductions', 'salesCommissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SalesReport  $salesReport
     * @return \Illuminate\Http\Response
     */
    public function edit(SalesReport $sale)
    {

        $selectedProducts = $sale->selectedProducts;
        $salesDeductions = $sale->salesDeductions;
        $salesCommissions = $sale->salesCommissions;

        // dump($sale);

        // return view('sales.edit', compact('sale', 'selectedProducts', 'salesDeductions', 'salesCommissions'));
        return view('sales.edit', compact('sale'));
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
