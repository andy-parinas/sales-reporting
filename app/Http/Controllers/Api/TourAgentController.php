<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TourAgentListResource;
use App\Http\Resources\TourAgentResource;
use App\TourAgent;
use Symfony\Component\HttpFoundation\Response;

class TourAgentController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {

        $agents = TourAgent::orderBy('name', 'asc')->paginate(10);

        return TourAgentListResource::collection($agents);
    }

    public function show(TourAgent $agent)
    {

        return new TourAgentResource($agent);
        
    }


    public function store()
    {
        $agent = TourAgent::create($this->validateData());

        return response($agent, Response::HTTP_CREATED);

    }




    private function validateData(){
        return request()->validate([
            'name' => 'required',
            'email' => '',
            'address' => '',
            'phone' => ''
        ]);
    }

}
