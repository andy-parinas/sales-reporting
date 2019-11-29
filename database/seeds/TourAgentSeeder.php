<?php

use App\Commission;
use App\CommissionType;
use App\TourAgent;
use App\TourCommission;
use App\TourType;
use Illuminate\Database\Seeder;

class TourAgentSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tourAgents = [
            'HARBOUR CITY', 'OZ LIFE', 'ROYAL HOLIDAY', 'S.S.K',
            'TOUR ACE', 'TOUR CHANNEL', 'TOUR ESSAY', 'WORLD WIDE',
            'TOUR MAP AUSTRALIA',
        ];


        foreach ($tourAgents as $agent) {
            $tourAgent = factory(TourAgent::class)->create([
                'name' => $agent,
                'address' => null,
                'email' => null,
                'phone' => null
            ]);

            
            $tourTypes = TourType::all();
            $commissionTypes = CommissionType::all();
            $commissions = Commission::all();

            foreach ($tourTypes as $tourType) {
                
                foreach ($commissionTypes as $commissionType) {
                    
                    foreach ($commissions as $commission) {
                        
                        factory(TourCommission::class)->create(([
                            'tour_agent_id' => $tourAgent->id,
                            'tour_type_id' => $tourType->id,
                            'commission_type_id' => $commissionType->id,
                            'commission_id' => $commission->id,
                            'amount' => 0
                        ]));

                    }
                }
            }
        } // End of TourAgents forEach
    }
}
