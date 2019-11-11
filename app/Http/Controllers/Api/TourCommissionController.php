<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\TourCommission;
use Symfony\Component\HttpFoundation\Response;

class TourCommissionController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function store()
    {

        $tourCommission = TourCommission::create($this->validateData());

        return response($tourCommission, Response::HTTP_CREATED);
    }


    public function update(TourCommission $commission)
    {
        
        $commission->update($this->validateData());

        return response($commission, Response::HTTP_OK);
    }



    private function validateData()
    {

        return request()->validate([
            'tour_agent_id' => 'sometimes|required',
            'tour_type_id' => 'sometimes|required',
            'commission_type_id' => 'sometimes|required',
            'commission_id' => 'sometimes|required',
            'amount' => 'required'
        ]);
    }
   
}
