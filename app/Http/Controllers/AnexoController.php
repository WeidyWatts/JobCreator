<?php

namespace App\Http\Controllers;

use App\Models\Anexo;
use Illuminate\Http\Request;

class AnexoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $anexos = Anexo::paginate(5);
        return view('biblioteca.anexo.index',['anexos'=>$anexos]);
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
        $file = $request->anexo;
        $name = uniqid(date('HisYmd'));
        $extension = $file->getClientOriginalExtension();
        $nameFile = "{$name}.{$extension}";
        $upload = $file->storeAs('anexos', $nameFile);
        if ($upload) {
            $anexo = Anexo::create([
                'titulo' => $request->titulo,
                'arquivo_anexo' => $nameFile
            ]);
            if($anexo) {
                return redirect()->route('anexo.index');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Anexo  $anexo
     * @return \Illuminate\Http\Response
     */
    public function show(Anexo $anexo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Anexo  $anexo
     * @return \Illuminate\Http\Response
     */
    public function edit(Anexo $anexo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Anexo  $anexo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Anexo $anexo)
    {
        if($request->hasFile('anexo')){
            $file = $request->anexo;
            $name = uniqid(date('HisYmd'));
            $extension = $file->getClientOriginalExtension();
            $nameFile = "{$name}.{$extension}";
            $upload = $file->storeAs('anexos', $nameFile);
            if($upload){
                $anexo->arquivo_anexo = $nameFile;
            }
        }
        $anexo->titulo = $request->titulo;

        if( $anexo->save()) {
            return redirect()->route('anexo.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Anexo  $anexo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Anexo $anexo)
    {
        $anexo->delete();
        return redirect()->route('anexo.index');
    }


    /**
     * Download the specified file from storage path.
     *
     * @param  $fileName
     * @return \Illuminate\Http\Response
     */
    public function download($fileName)
    {
        $file_path = storage_path('app/anexos/'.$fileName);
        return response()->download($file_path);
    }

}
