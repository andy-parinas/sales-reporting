<?php

use App\Deduction;
use Illuminate\Database\Seeder;

class DeductionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        collect(['Guide Incentive', 'Delivery', 'Service'])->each(function($type){

            if($type === 'Service'){
                factory(Deduction::class)->create(['name' => $type, 'type' => 3, 'amount' => 0]);
            }
            
            if($type === 'Guide Incentive') {
                factory(Deduction::class)->create(['name' => $type, 'type' => 1, 'amount' => 50]);
            }

            if($type === 'Delivery') {
                factory(Deduction::class)->create(['name' => $type, 'type' => 1, 'amount' => 200]);
            }

        });
    }
}
