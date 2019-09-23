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
        
        $products = factory(Product::class)->create();

         $this->get('/products')
            ->assertOk()
            ->assertViewHas('products');
            
    }


    /** @test */
    public function product_can_be_fetched()
    {

        $product = factory(Product::class)->create();

        
        $this->get('/products/' . $product->id)
            ->assertOk()
            ->assertViewHas('product')
            ->assertSee($product->name);

    }

    /** @test */
    public function product_can_be_created()
    {
        $this->withoutExceptionHandling();

        $data = factory(Product::class)->raw();

        $this->post('/products', $data)
            ->assertRedirect('/products/' . Product::first()->id);

        $this->assertCount(1, Product::all());

    }


    /** @test */
    public function product_can_be_updated()
    {
        $this->withoutExceptionHandling();

        $product = factory(Product::class)->create();
        
        $this->patch('/products/' . $product->id, ['name' => 'Foo Bar', 'description' => 'Foo Bar', 'price' => 10])
            ->assertRedirect('/products/' . $product->id);

        $product->refresh();

        $this->assertEquals('Foo Bar', $product->name);
        $this->assertEquals('Foo Bar', $product->description);
        $this->assertEquals(10, $product->price);

    }


    /** @test */
    public function product_fields_are_required()
    {
        // $this->withoutExceptionHandling();
        
        $fields = collect(['name', 'description', 'product_type_id', 'price']);

        $fields->each(function($field){

            $data = factory(Product::class)->raw([$field => '']);

            $this->post('/products', $data)
                ->assertSessionHasErrors($field);

            $this->assertCount(0, Product::all());
        });

    }


    /** @test */
    public function product_can_be_deleted()
    {
        $this->withoutExceptionHandling();

        $product = factory(Product::class)->create();

        $this->delete('/products/'. $product->id)
            ->assertRedirect('/products');


        $this->assertCount(0, Product::all());

    }



}
