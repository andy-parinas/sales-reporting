<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TourGuideResource;
use App\TourGuide;
use Symfony\Component\HttpFoundation\Response;

class TourGuideController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth:api');
    }


    public function index()
    {
        $guides = TourGuide::orderBy('name', 'asc')->paginate(10);

        return TourGuideResource::collection($guides);
    }


    public function store()
    {
        $guide = TourGuide::create($this->validateData());

        return response($guide, Response::HTTP_CREATED);
    }

    public function update(TourGuide $guide)
    {
        $guide->update($this->validateData());

        return response($guide, Response::HTTP_OK);
    }

    public function destroy(TourGuide $guide)
    {
        $guide->delete();

        return response([], Response::HTTP_OK);
    }



    private function validateData()
    {
        return request()->validate([
            'name' => 'required',
            'email' => '',
            'phone' => ''
        ]);
    }


}
