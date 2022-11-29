<?php

namespace App\Http\Controllers;

use App\Models\Journey;
use Illuminate\Http\Request;
use App\Http\Controllers\ModuloController;

class JourneyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $journeys = Journey::with('modulos')->paginate(5);

        return view('journey.index', ['journeys'=>$journeys]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Journey::create($request->all());
        return redirect()->route('journey.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\journey  $journey
     * @return \Illuminate\Http\Response
     */
    public function show(journey $journey)
    {
        $modulo = new ModuloController();
      return $modulo->index($journey->id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\journey  $journey
     * @return \Illuminate\Http\Response
     */
    public function edit(journey $journey)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\journey  $journey
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, journey $journey)
    {
        $journey->titulo = $request->titulo;
        $journey->save();
        return redirect()->route('journey.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\journey  $journey
     * @return \Illuminate\Http\Response
     */
    public function destroy(journey $journey)
    {
        $journey->delete();
        return redirect()->route('journey.index');
    }
}
