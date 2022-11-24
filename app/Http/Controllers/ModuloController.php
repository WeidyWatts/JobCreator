<?php

namespace App\Http\Controllers;

use App\Models\Modulo;
use App\Models\Anexo_Modulo;
use App\Models\Artigo_Modulo;
use App\Models\Link_Modulo;
use App\Models\Teste_Modulo;
use App\Models\Video_Modulo;
use Illuminate\Http\Request;

class ModuloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $modulos = Modulo::where('journey_id',$id)->paginate(5);

        foreach ($modulos as $modulo) {
         $anexos[$modulo->id] = Anexo_Modulo::where('modulo_id', $modulo->id)->count();
         $artigos[$modulo->id] = Artigo_Modulo::where('modulo_id', $modulo->id)->count();
         $links[$modulo->id] = Link_Modulo::where('modulo_id', $modulo->id)->count();
         $testes[$modulo->id] = Teste_Modulo::where('modulo_id', $modulo->id)->count();
         $videos[$modulo->id] = Video_Modulo::where('modulo_id', $modulo->id)->count();


        }

        $ToFront = [
            'modulos'=>$modulos,
            'journey_id'=>$id,
            'anexos'=>$anexos,
            'artigos'=>$artigos,
            'links'=>$links,
            'testes'=>$testes,
            'videos'=>$videos,
        ];


        return view('journey.modulo.index',$ToFront);
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

       $modulo = Modulo::create([
           'titulo'=>$request->titulo,
           'journey_id'=>$request->journey_id]);

        if(isset($request->anexos)){
            foreach ($request->anexos as $anexo){
                Anexo_Modulo::create([
                    'modulo_id' =>  $modulo->id,
                    'anexo_id'=> $anexo
                ]);
           }
        }

       if(isset($request->artigos)){
           foreach ($request->artigos as $artigo){
                Artigo_Modulo::create([
                   'modulo_id' =>  $modulo->id,
                    'artigo_id'=> $artigo
                ]);
           }
       }

        if(isset($request->links)){
            foreach ($request->links as $link){
                Link_Modulo::create([
                    'modulo_id' =>  $modulo->id,
                    'link_id'=> $link
                ]);
            }
        }

        if(isset($request->testes)){
            foreach ($request->testes as $teste){
                Teste_Modulo::create([
                    'modulo_id' =>  $modulo->id,
                    'teste_id'=> $teste
                ]);
            }
        }

        if(isset($request->videos)){
            foreach ($request->videos as $video){
                Video_Modulo::create([
                    'modulo_id' =>  $modulo->id,
                    'video_id'=> $video
                ]);
            }
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Modulo  $Modulo
     * @return \Illuminate\Http\Response
     */
    public function show(Modulo $Modulo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Modulo  $Modulo
     * @return \Illuminate\Http\Response
     */
    public function edit(Modulo $Modulo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Modulo  $Modulo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Modulo $Modulo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Modulo  $Modulo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Modulo $modulo)
    {
        $modulo->delete();
        return redirect()->back();
    }
}
