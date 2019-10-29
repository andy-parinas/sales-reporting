<?php

use App\Commission;
use App\CommissionType;
use App\Deduction;
use App\Product;
use App\ProductType;
use App\TourAgent;
use App\TourCommission;
use App\TourGuide;
use App\TourType;
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        collect(['Carpet', 'Item'])->each(function($type){

            if($type === 'Carpet'){
                $productType = factory(ProductType::class)->create(['name' => $type, 'code' => 1]);
            }

            if($type === 'Item'){
                $productType = factory(ProductType::class)->create(['name' => $type, 'code' => 2]);
            }
            

            // factory(Product::class, 12)->create(['product_type_id' => $productType->id]); //Comment out for production seed

        });


        $commissionType1 = factory(CommissionType::class)->create([
            'name' => 'High Value',
            'code' => 1
        ]);

        $commissionType2 = factory(CommissionType::class)->create([
            'name' => 'Regular Value',
            'code' => 2
        ]);

        $tourType1 = factory(TourType::class)->create([
            'name' => 'Package'
        ]);

        $tourType2 = factory(TourType::class)->create([
            'name' => 'Honeymoon'
        ]);

        $commissionTypes = collect([$commissionType1, $commissionType2]);
        $tourTypes = collect([$tourType1, $tourType2]);
        
        factory(TourAgent::class, 10)->create(); // Comment out for production seed



        collect([['TA', 0.50], ['T/G', 0.10], ['Manager', 0.07], ['G.Company', 0.01], ['Extra', 0.10], ['Prepaid', 0.04] ])->each(function($comm) use ($commissionTypes, $tourTypes) {
            
            $commission = factory(Commission::class)->create(['name' => $comm[0]]);

            foreach (TourAgent::all() as $agent) {
                
                foreach ($tourTypes as $tourType) {
                   
                    foreach ($commissionTypes as $commissionType) {
                        factory(TourCommission::class)->create([
                            'tour_agent_id' => $agent->id,
                            'tour_type_id' => $tourType->id,
                            'commission_type_id' => $commissionType->id,
                            'commision_id' => $commission->id,
                            'amount' => $comm[1]
                        ]);
                    }

                }



            }

        });


        collect(['Guide Incentive', 'Delivery', 'Service'])->each(function($type){

            if($type === 'Service'){
                factory(Deduction::class)->create(['name' => $type, 'type' => 3]);
            }
            
            if($type === 'Guide Incentive') {
                factory(Deduction::class)->create(['name' => $type, 'type' => 1, 'amount' => 50]);
            }

            if($type === 'Delivery') {
                factory(Deduction::class)->create(['name' => $type, 'type' => 1, 'amount' => 200]);
            }

        });

        factory(User::class)->create([
            'name' => 'Administrator',
            'email' => 'admin@salesreport.com'
        ]);

        // factory(User::class, 5)->create(); //comment out for production seed

        factory(TourGuide::class, 15)->create(); // Comment out for production seed


    }
}
