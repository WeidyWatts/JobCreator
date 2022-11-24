<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entrevista;

class EntrevistaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Entrevista::max('id');
        return view('material_de_apoio.entrevista.index', ['entrevista'=>$data]);

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
        $file = $request->entrevista;
        $name = uniqid(date('HisYmd'));
        $extension = $file->getClientOriginalExtension();
        $nameFile = "{$name}.{$extension}";
        $upload = $file->storeAs('entrevista', $nameFile);
        if ($upload) {
            $entrevista = Entrevista::create([
                'entrevista' => $nameFile
            ]);
            if($entrevista) {
                return redirect()->route('entrevista.index');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function download($fileName)
    {
        $entrevista = Entrevista::find($fileName);
        $file_path = storage_path('app/entrevista/'.$entrevista->entrevista);
        return response()->download($file_path);
    }
}
