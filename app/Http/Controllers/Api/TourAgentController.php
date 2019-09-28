<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TourAgentListResource;
use App\TourAgent;

class TourAgentController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        return TourAgentListResource::collection(TourAgent::all());
    }
}
