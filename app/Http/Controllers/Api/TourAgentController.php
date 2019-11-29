<?php

namespace App\Http\Controllers\Api;

use App\Commission;
use App\CommissionType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TourAgentListResource;
use App\Http\Resources\TourAgentResource;
use App\TourAgent;
use App\TourCommission;
use App\TourType;
use Exception;
use Illuminate\Support\Facades\DB;
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

        DB::beginTransaction();

        try {
            
            //Create the Tour Agent
            $tourAgent = TourAgent::create($this->validateData());

            //Create the TourCommission
            $tourTypes = TourType::all();
            $commissionTypes = CommissionType::all();
            $commissions = Commission::all();

            foreach ($tourTypes as $tourType) {
                
                foreach ($commissionTypes as $commissionType) {
                    
                    foreach ($commissions as $commission) {
                        
                        TourCommission::create([
                            'tour_agent_id' => $tourAgent->id,
                            'tour_type_id' => $tourType->id,
                            'commission_type_id' => $commissionType->id,
                            'commission_id' => $commission->id,
                            'amount' => 0
                        ]);

                    }
                }
            }

            DB::commit();

            return response($tourAgent, Response::HTTP_CREATED);


        } catch (Exception $e) {

            DB::rollBack();
            return response(['error' => $e], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

       

    }

    public function update(TourAgent $agent)
    {
        $agent->update($this->validateData());

        return response($agent, Response::HTTP_OK);
    }

    public function destroy(TourAgent $agent)
    {
        $agent->delete();

        return response([], Response::HTTP_OK);
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
