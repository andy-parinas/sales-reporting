<?php

namespace App\Http\Controllers\Api;

use App\Commission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommissionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        return Commission::all();
    }
}
