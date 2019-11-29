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


    /**
     *  @Description:   Get TourCommissions
     *  @Route          GET /api/tour-commissions?tourAgent=<tour_agent_id>&&tourType=<tour_type_id>
     *      
     */
    public function index(Request $request)
    {
   
        if($request->has('tourAgent') && $request->has('tourType')){

            $tourCommissions = TourCommission::where([
                ['tour_agent_id', '=', request('tourAgent')],
                ['tour_type_id', '=', request('tourType')],
            ])->get();


            return response($tourCommissions, Response::HTTP_OK);
        }

        $tourCommissions = TourCommission::paginate(10);

        return response($tourCommissions, Response::HTTP_OK);

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
