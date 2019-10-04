<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TourAgentListResource;
use App\Http\Resources\TourAgentResource;
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

    public function show(TourAgent $agent)
    {

        return new TourAgentResource($agent);
        
    }
}
