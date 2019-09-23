<?php

namespace Tests\Feature;

use App\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductFeatureTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function products_can_be_listed()
    {
        $this->withExceptionHandling();
        
        $products = factory(Product::class)->create();

         $this->get('/products')
            ->assertOk()
            ->assertViewHas('products');
            
    }


    /** @test */
    public function product_can_be_fetched()
    {
        $this->withExceptionHandling();

        $product = factory(Product::class)->create();

        
        $this->get('/products/' . $product->id)
            ->assertOk()
            ->assertViewHas('product')
            ->assertSee($product->name);

    }

}
