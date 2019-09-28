<?php

use App\Commission;
use App\Product;
use App\ProductType;
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
            

            factory(Product::class, 12)->create(['product_type_id' => $productType->id]);

        });

        collect([1,2,3,4])->each(function($type){

            if($type === 1){
                factory(Commission::class)->create([
                    'name' => 'Code1',
                    'commission_type' => $type,
                    'amount' => 0.46
                ]);
            };

            if($type === 2){
                factory(Commission::class)->create([
                    'name' => 'Code2',
                    'commission_type' => $type,
                    'amount' => 0.41
                ]);
            };

            if($type === 3){
                factory(Commission::class)->create([
                    'name' => 'Guide',
                    'commission_type' => $type,
                    'amount' => 0.07
                ]);
            };

            if($type === 4){
                factory(Commission::class)->create([
                    'name' => 'Manager',
                    'commission_type' => $type,
                    'amount' => 0.01
                ]);
            };

        });


        factory(User::class, 5)->create();


    }
}
