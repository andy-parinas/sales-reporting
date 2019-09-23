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
        
        $products = factory(Product::class, 5)->create();

        $this->get('/api/products',  [['Accept' => 'application/json', 'Content-Type' => 'application/json']])
            ->assertJsonCount(5);


    }
}
