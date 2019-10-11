<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ProductType;
use Symfony\Component\HttpFoundation\Response;

class ProductTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    public function index()
    {
        return ProductType::all();
    }

    public function store()
    {
        $data = $this->validateData();

        $productType = ProductType::create($data);

        return response($productType, Response::HTTP_CREATED);

    }


    public function validateData()
    {
        return request()->validate([
            'name' => 'required',
            'code' => 'required'
        ]);
    }

}
