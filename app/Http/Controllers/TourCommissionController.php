<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * This will handle all the related commissions functionality
 * TourCommission, Commissions, CommissionTypes, TourTypes
 */
class TourCommissionController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('commissions.index');
    }


}
