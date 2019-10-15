<?php

namespace App\Http\Controllers;

use App\TourAgent;
use Illuminate\Http\Request;

class TourAgentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agents = TourAgent::all();

        return view('agents.index', compact('agents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('agents.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->all();

        $agent = TourAgent::create($data);

        return redirect('/agents/' . $agent->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TourAgent  $tourAgent
     * @return \Illuminate\Http\Response
     */
    public function show(TourAgent $agent)
    {
        return view('agents.show', compact('agent'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TourAgent  $tourAgent
     * @return \Illuminate\Http\Response
     */
    public function edit(TourAgent $agent)
    {
        
        return view('agents.edit', compact('agent'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TourAgent  $tourAgent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TourAgent $agent)
    {
        $data = request()->all();

        $agent->update($data);

        return redirect('/agents/' . $agent->id);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TourAgent  $tourAgent
     * @return \Illuminate\Http\Response
     */
    public function destroy(TourAgent $agent)
    {
        $agent->delete();

        return redirect('/agents');
    }
}
