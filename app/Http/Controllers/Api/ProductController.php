<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Product;

class ProductController extends Controller
{
   public function __construct()
   {
       $this->middleware('auth:api');
   }

    public function index()
    {
 
        if(request()->search !== null){
            return new ProductCollection(Product::search(request()->search)->paginate(10));
        }

        return new ProductCollection(Product::paginate(10));
    }
}
