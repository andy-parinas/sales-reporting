<?php

namespace Tests\Unit;

use App\Product;
use App\ProductType;
use App\SelectedProduct;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    use RefreshDatabase;
   
    /** @test */
    public function product_has_product_type()
    {
        $product = factory(Product::class)->create();

        $this->assertInstanceOf(ProductType::class, $product->productType);

    }

    /** @test */
    public function product_have_selected_products()
    {
        $product = factory(Product::class)->create();
        factory(SelectedProduct::class)->create(['product_id' => $product->id]);


        $this->assertContainsOnlyInstancesOf(SelectedProduct::class, $product->selectedProducts);

    }

}
