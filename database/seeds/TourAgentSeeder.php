<?php

use App\TourAgent;
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
            factory(TourAgent::class)->create([
                'name' => $agent,
                'address' => null,
                'email' => null,
                'phone' => null
            ]);
        }
    }
}
