<?php

namespace Tests\Unit;

use App\Product;
use App\ProductType;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    use RefreshDatabase;
   
    /** @test */
    public function it_has_product_type()
    {
        
        $product = factory(Product::class)->create();

        $this->assertInstanceOf(ProductType::class, $product->productType);


    }
}
