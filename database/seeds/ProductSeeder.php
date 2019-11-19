<?php

use App\Product;
use App\ProductType;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
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
            

            factory(Product::class, 12)->create(['product_type_id' => $productType->id]); //Comment out for production seed

        });

    }
}
