<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    

    public function index()
    {
        $products = Product::all();

        return view('products.index', compact('products'));
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }


    public function store()
    {
        $data = $this->validateData();

        $product = Product::create($data);

        return redirect('/products/' . $product->id);

    }


    public function update(Product $product)
    {
        
        $product->update($this->validateData());

        return redirect('/products/' . $product->id);

    }


    public function destroy(Product $product)
    {
        $product->delete();


        return redirect('/products');
    }


    private function validateData()
    {
        return request()->validate([
            'name' => 'required',
            'description' => 'required',
            'product_type_id' => 'required',
            'price' => 'required'
        ]);
    }

}
