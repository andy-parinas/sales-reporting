<?php

use App\TourType;
use Illuminate\Database\Seeder;

class TourTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        collect(['Package Group', 'Package FIT', 'Honeymoon Group', 'Honeymoon FIT'])->each(function($tour){

            factory(TourType::class)->create([
                'name' => $tour
            ]);

        });

    }
}
