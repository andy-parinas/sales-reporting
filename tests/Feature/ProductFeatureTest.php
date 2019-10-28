<?php

namespace Tests\Feature;

use App\Product;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductFeatureTest extends TestCase
{
    use RefreshDatabase;




    /** @test */
    public function product_can_be_fetched()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);

        $product = factory(Product::class)->create();

        
        $this->get('/products/' . $product->id)
            ->assertOk()
            ->assertViewHas('product')
            ->assertSee($product->name);

    }


 



}
