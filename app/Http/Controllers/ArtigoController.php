<?php

namespace App\Http\Controllers;

use App\Models\Artigo;
use Illuminate\Http\Request;

class ArtigoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $artigos = Artigo::paginate(5);
        return view('biblioteca.artigo.index',['artigos'=>$artigos]);

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
        $artigo = Artigo::create($request->all());

        if($artigo){
            return redirect()->route('artigo.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Artigo  $artigo
     * @return \Illuminate\Http\Response
     */
    public function show(Artigo $artigo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Artigo  $artigo
     * @return \Illuminate\Http\Response
     */
    public function edit(Artigo $artigo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Artigo  $artigo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Artigo $artigo)
    {
        $artigo->titulo = $request->titulo;
        $artigo->autor = $request->autor;
        $artigo->link = $request->link;
        $artigo->ano_publicacao = $request->ano_publicacao;
        $artigo->save();

        return redirect()->route('artigo.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Artigo  $artigo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Artigo $artigo)
    {
        $artigo->delete();
        return redirect()->route('artigo.index');
    }

    public function getSelect2Json() {
        $data = Artigo::get();
        $select2 = [];
        foreach ($data as $item) {
            $select2[] = ['id'=>$item->id, 'text' =>$item->titulo];
        }
        return response()->json($select2);
    }
}
