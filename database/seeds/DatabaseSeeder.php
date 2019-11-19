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

        $this->call([
            ProductSeeder::class,
            TourTypeSeeder::class,
            CommissionSeeder::class,
            TourAgentSeeder::class,
            DeductionSeeder::class
        ]);
        
 
        factory(User::class)->create([
            'name' => 'Administrator',
            'email' => 'admin@salesreport.com'
        ]);

        factory(TourGuide::class, 15)->create(); // Comment out for production seed


    }
}
