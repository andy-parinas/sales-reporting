<?php

namespace App\Http\Controllers\Api;

use App\Commission;
use App\CommissionType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\TourAgent;
use App\TourCommission;
use App\TourType;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class TourTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }


    public function index()
    {
        return TourType::all();
    }


    public function store()
    {
        DB::beginTransaction();

        try {
            
            $tourType = TourType::create($this->validateData());

            $tourAgents = TourAgent::all();
            $commissionTypes = CommissionType::all();
            $commissions = Commission::all();

            foreach ($tourAgents as $agent) {
                
                foreach ($commissions as $commission) {
                    
                    foreach ($commissionTypes as $commissionType) {
                        
                        TourCommission::create([
                            'tour_type_id' => $tourType->id,
                            'tour_agent_id' => $agent->id,
                            'commission_id' => $commission->id,
                            'commission_type_id' => $commissionType->id,
                            'amount' => 0
                        ]);

                    }
                }
            }

            DB::commit();

            return response($tourType, Response::HTTP_CREATED);

        } catch (Exception $e) {
            DB::rollBack();
            return response(['error' => $e ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
       
    }

    public function update(TourType $type)
    {
        $type->update($this->validateData());

        return response($type, Response::HTTP_OK);
    }
    

    public function destroy(TourType $type)
    {
        // $type->delete();
        DB::beginTransaction();

        try {
            
            $type->tourCommissions->each(function($tourCommission){
                $tourCommission->delete();
            });

            $type->delete();

            DB::commit();

            return response([], Response::HTTP_OK);


        } catch (Exception $e) {
            
            DB::rollBack();
            return response(['error' => $e], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }


    private function validateData()
    {
        return request()->validate([
            'name' => 'required',
            'description' => ''
        ]);
    }


}
