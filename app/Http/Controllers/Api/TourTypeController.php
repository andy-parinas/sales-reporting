<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\TourType;
use Symfony\Component\HttpFoundation\Response;

class TourTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }


    public function index()
    {
        return TourType::all();
    }


    public function store()
    {
        $tourType = TourType::create($this->validateData());

        return response($tourType, Response::HTTP_CREATED);
    }

    public function update(TourType $type)
    {
        $type->update($this->validateData());

        return response($type, Response::HTTP_OK);
    }
    

    public function destroy(TourType $type)
    {
        $type->delete();

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
