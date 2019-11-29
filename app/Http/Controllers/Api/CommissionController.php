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

    public function store()
    {

        DB::beginTransaction();

        try {
            
            $commission = Commission::create($this->validateData());

            $tourTypes = TourType::all();
            $tourAgents = TourAgent::all();
            $commissionTypes = CommissionType::all();

            foreach ($tourAgents as $tourAgent) {
                foreach ($tourTypes as $tourType) {
                    foreach ($commissionTypes as $commissionType) {
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

            return response($commission, Response::HTTP_CREATED);

        } catch (Exception $e) {

            DB::rollBack();
            return response(['error' => $e], Response::HTTP_INTERNAL_SERVER_ERROR);
        }


    }

    public function update(Commission $commission)
    {
        $commission->update($this->validateData());

        return response($commission, Response::HTTP_OK);
    }


    public function destroy(Commission $commission)
    {
        DB::beginTransaction();

        try {
            
            $commission->tourCommissions->each(function($tourCommission){
                $tourCommission->delete();
            });

            $commission->delete();

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
