<?php

namespace App\Http\Controllers;

use App\TourGuide;
use Illuminate\Http\Request;

class TourGuideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('guides.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('guides.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TourGuide  $tourGuide
     * @return \Illuminate\Http\Response
     */
    public function show(TourGuide $guide)
    {
        return view('guides.show', compact('guide'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TourGuide  $tourGuide
     * @return \Illuminate\Http\Response
     */
    public function edit(TourGuide $guide)
    {
        return view('guides.edit', compact('guide'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TourGuide  $tourGuide
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TourGuide $tourGuide)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TourGuide  $tourGuide
     * @return \Illuminate\Http\Response
     */
    public function destroy(TourGuide $tourGuide)
    {
        //
    }
}
