<?php

namespace App\Http\Controllers\Api;

use App\CommissionType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommissionTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }


    public function index()
    {
        return CommissionType::all();
    }
}
