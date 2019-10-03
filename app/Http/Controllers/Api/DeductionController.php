<?php

namespace App\Http\Controllers\Api;

use App\Deduction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DeductionController extends Controller
{
    

    public function index()
    {
        return Deduction::all();
    }
}
