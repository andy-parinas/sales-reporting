<?php

namespace Tests\Feature;

use App\Product;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductApiTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function user_can_list_products_via_api()
    {
        $user = factory(User::class)->create();

        $product = factory(Product::class)->create();

        $response = $this->get('/api/products?api_token=' . $user->api_token);

        $response->assertJson([
            'data' => [
               [ 'name' => $product->name,
                'description' => $product->description,
                'price' => $product->price,
                'product_type_id' => $product->product_type_id,
                'product_type' => $product->productType->name]
            ]
        ]);
        
    }

    /** @test */
    public function product_list_api_response_has_links()
    {
        $user = factory(User::class)->create();

        $product = factory(Product::class)->create();

        $response = $this->get('/api/products?api_token=' . $user->api_token);

         $response->assertJsonStructure([
            'links' => [
              'first',
              'last',
              'prev',
              'next'
            ]
        ]);
        
    }

    
    /** @test */
    public function product_list_api_response_has_meta()
    {
        $user = factory(User::class)->create();

        $product = factory(Product::class)->create();

        $response = $this->get('/api/products?api_token=' . $user->api_token);

         $response->assertJsonStructure([
            'meta' => [
              'current_page',
              'from',
              'last_page',
              'path',
              'per_page',
              'to',
              'total'
            ]
        ]);
        
    }

    /** @test */
    public function user_can_change_product_list_page_via_api()
    {
        $user = factory(User::class)->create();

        //Create 10 Products. This will be the first page
        factory(Product::class,10)->create();

        //Create 1 product for the second page
        $lastProduct = factory(Product::class)->create();;

        $url = '/api/products?api_token=' . $user->api_token . '&page=2';

        $response = $this->get($url);

        //If successfully assert, we know that the next page has been loaded
        $response->assertJson([
            'data' => [
               [ 'name' => $lastProduct->name,
                'description' => $lastProduct->description,
                'price' => $lastProduct->price,
                'product_type_id' => $lastProduct->product_type_id,
                'product_type' => $lastProduct->productType->name]
            ]
        ]);
        
    }

    /** @test */
    public function user_can_search_product_via_api()
    {
        $user = factory(User::class)->create();

        //Hay Stack
        factory(Product::class,15)->create();

        //Needle
        $product =factory(Product::class)->create(['name' => 'FooBar']);

        $url = '/api/products?api_token=' . $user->api_token . '&search=FooBar';

        $response = $this->get($url);

        $response->assertJson([
            'data' => [
               [ 'name' => 'FooBar',
                'description' => $product->description,
                'price' => $product->price,
                'product_type_id' => $product->product_type_id,
                'product_type' => $product->productType->name]
            ]
        ]);

    }

    /** @test */
    public function can_create_product_via_api()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();

        $data = factory(Product::class)->raw();

        $this->post('/api/products', array_merge($data, ['api_token' => $user->api_token]))
            ->assertStatus(201);

        $this->assertCount(1, Product::all());
        
    }

    /** @test */
    public function fields_are_required_via_api()
    {

        $user = factory(User::class)->create();

        $fields = collect(['name', 'description', 'product_type_id', 'price']);

        $fields->each(function($field) use ($user){

            $data = factory(Product::class)->raw([$field => '']);

            $this->post('/api/products', array_merge($data, ['api_token' => $user->api_token]))
                ->assertSessionHasErrors($field);

            $this->assertCount(0, Product::all());
        });
    }
}
