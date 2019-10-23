<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Product;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
   public function __construct()
   {
       $this->middleware('auth:api');
   }

    public function index()
    {
 
        if(request()->search !== null){
            // return new ProductCollection(Product::search(request()->search)->paginate(10));
            $search = '%' . request()->search .'%';

            $products = Product::where('name', 'like', $search)
                                ->orWhere('description', 'like',  $search)
                                ->paginate(10);

            // dd($products);
            
            return new ProductCollection($products);

        }

        return new ProductCollection(Product::paginate(10));
    }


    public function store()
    {

        $product = Product::create($this->validateData());

        return response($product, Response::HTTP_CREATED);

    }

    public function update(Product $product)
    {
        $product->update($this->validateData());

        return response($product, Response::HTTP_OK);
    }


    public function destroy(Product $product)
    {
        $product->delete();

        return response([], Response::HTTP_OK);
    }


    private function validateData()
    {
        return request()->validate([
            'name' => 'required',
            'description' => 'required',
            'product_type_id' => 'required',
            'cost' => 'required',
            'price' => 'required'
        ]);
    }
}
