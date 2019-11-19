<?php

use App\Commission;
use App\CommissionType;
use Illuminate\Database\Seeder;

class CommissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        factory(CommissionType::class)->create([
            'name' => 'High Value',
            'code' => 1
        ]);

        factory(CommissionType::class)->create([
            'name' => 'Regular Value',
            'code' => 2
        ]);

        collect(['TA', 'TG', 'Manager', 'G.Company', 'Extra'])->each(function($commission){
            factory(Commission::class)->create(['name' => $commission]);
        });

    }
}
