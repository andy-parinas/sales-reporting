<?php

namespace App\Http\Controllers\Api;

use App\Commission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class CommissionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        return Commission::all();
    }

    public function store()
    {
        $commission = Commission::create($this->validateData());

        return response($commission, Response::HTTP_CREATED);
    }

    public function update(Commission $commission)
    {
        $commission->update($this->validateData());

        return response($commission, Response::HTTP_OK);
    }


    public function destroy(Commission $commission)
    {
        $commission->delete();

        return response([], Response::HTTP_OK);
    }


    private function validateData()
    {
        return request()->validate([
            'name' => 'required',
            'description' => ''
        ]);
    }
}
