<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $products = Product::all();

        if(request()->isJson()){
            return $products;
        }

        return view('products.index', compact('products'));
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function create()
    {
        $product = new Product();

        return view('products.create', compact('product'));
    }

    public function store()
    {
        $data = $this->validateData();

        $product = Product::create($data);

        return redirect('/products/' . $product->id);

    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
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
