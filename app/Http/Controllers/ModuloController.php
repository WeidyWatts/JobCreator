<?php

namespace App\Http\Controllers;

use App\Models\Modulo;
use App\Models\Anexo_Modulo;
use App\Models\Artigo_Modulo;
use App\Models\Link_Modulo;
use App\Models\Teste_Modulo;
use App\Models\Video_Modulo;
use App\Models\Journey;
use App\Models\Anexo;
use App\Models\Artigo;
use App\Models\Link;
use App\Models\Video;
use App\Models\Teste;
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
        $journey = Journey::find($id);

        $modulos = Modulo::where('journey_id',$journey->id)->paginate(5);

        foreach ($modulos as $modulo) {
            $anexos[$modulo->id] = Anexo_Modulo::where('modulo_id', $modulo->id)->count();
            $artigos[$modulo->id] = Artigo_Modulo::where('modulo_id', $modulo->id)->count();
            $links[$modulo->id] = Link_Modulo::where('modulo_id', $modulo->id)->count();
            $testes[$modulo->id] = Teste_Modulo::where('modulo_id', $modulo->id)->count();
            $videos[$modulo->id] = Video_Modulo::where('modulo_id', $modulo->id)->count();

        }

        $ToFront = [
            'modulos'=>$modulos ?? null,
            'journey'=>$journey ?? null,
            'anexos'=>$anexos ?? null,
            'artigos'=>$artigos ?? null,
            'links'=>$links ?? null,
            'testes'=>$testes ?? null,
            'videos'=>$videos ?? null,
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
    public function show(Modulo $modulo)
    {
        $AnexoModuloIds = [];
        $getAnexo = Anexo_Modulo::where('modulo_id', $modulo->id)->get();
        foreach ($getAnexo as $i) {
            $AnexoModuloIds[] = $i->anexo_id;
        }
        if(count($AnexoModuloIds) > 0) {
            $anexo = Anexo::whereIn('id',$AnexoModuloIds)->get();
        }else {
            $anexo = [];
        }


        $ArtigoModuloIds = [];
        $getArtigo = Artigo_Modulo::where('modulo_id', $modulo->id)->get();
        foreach ($getArtigo as $it) {
            $ArtigoModuloIds[] = $it->artigo_id;
        }
        if(count($ArtigoModuloIds) > 0) {
            $artigo = Artigo::get();
        }else {
            $artigo = [];
        }


        $LinkModuloIds = [];
        $getLink = Link_Modulo::where('modulo_id', $modulo->id)->get();
        foreach ($getLink as $ite) {
            $LinkModuloIds[] = $ite->link_id;
        }
        if(count($LinkModuloIds)>0) {
            $link = Link::whereIn('id',$LinkModuloIds)->get();
        }else {
            $link = [];
        }

        $VideoModuloIds = [];
        $getVideo = Video_Modulo::where('modulo_id', $modulo->id)->get();
        foreach ($getVideo as $item) {
            $VideoModuloIds[] = $item->video_id;
        }
        if(count($VideoModuloIds)>0) {
            $video = Video::whereIn('id',$VideoModuloIds)->get();
        } else {
            $video = [];
        }

        $TesteModuloIds = [];
        $getTeste = Teste_Modulo::where('modulo_id', $modulo->id)->get();
        foreach ($getTeste as $item0) {
            $TesteModuloIds[] = $item0->teste_id;
        }
        if(count($TesteModuloIds)>0) {
            $teste = Teste::whereIn('id',$TesteModuloIds)->get();
        } else {
            $teste = [];
        }


        return view('journey.modulo.conteudos.index',
            [
                'modulo'    =>$modulo,
                'anexos'    =>$anexo,
                'artigos'   =>$artigo,
                'links'     =>$link,
                'videos'    =>$video,
                'testes'    =>$teste
            ]);

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
        return redirect()->back();
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
