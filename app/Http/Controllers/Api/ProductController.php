<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;

class ProductController extends Controller
{
   public function __construct()
   {
       $this->middleware('auth:api');
   }

    public function index()
    {
        return Product::all();
    }
}
