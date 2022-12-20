<?php

namespace App\Http\Controllers;

use App\Models\Anexo;
use App\Models\Artigo;
use App\Models\Link;
use App\Models\Teste;
use App\Models\usuario_f_anexo;
use App\Models\usuario_f_artigo;
use App\Models\usuario_f_link;
use App\Models\usuario_f_teste;
use App\Models\usuario_f_video;
use App\Models\Video;
use Illuminate\Http\Request;

class FavoritosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fav_anexo = usuario_f_anexo::where('user_id', auth()->user()->id)->get();
        $aux0 = [];
        foreach($fav_anexo as $fav0)
        {
            $aux0[] = $fav0->anexo_id;
        }
        $anexos = Anexo::whereIn('id', $aux0)->get();


        $fav_artigo = usuario_f_artigo::where('user_id', auth()->user()->id)->get();
        $aux1 = [];
        foreach($fav_artigo as $fav1)
        {
            $aux1[] = $fav1->artigo_id;
        }
        $artigos = Artigo::whereIn('id', $aux1)->get();



        $fav_link = usuario_f_link::where('user_id', auth()->user()->id)->get();
        $aux2 = [];
        foreach($fav_link as $fav2)
        {
            $aux2[] = $fav2->link_id;
        }
        $links = Link::whereIn('id', $aux2)->get();



        $fav_teste = usuario_f_teste::where('user_id', auth()->user()->id)->get();
        $aux3 = [];
        foreach($fav_teste as $fav3)
        {
            $aux3[] = $fav3->teste_id;
        }
        $testes = Teste::whereIn('id', $aux3)->get();


        $fav_video = usuario_f_video::where('user_id', auth()->user()->id)->get();
        $aux4 = [];
        foreach($fav_video as $fav4)
        {
            $aux4[] = $fav4->video_id;
        }
        $videos = Video::whereIn('id', $aux4)->get();


        $ToFront = [
            'anexos'=>$anexos ?? null,
            'artigos'=>$artigos ?? null,
            'links'=>$links ?? null,
            'testes'=>$testes ?? null,
            'videos'=>$videos ?? null,
        ];

        return view('favoritos.index', $ToFront);
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
        switch ($request->tipo){
            case 'anexo':
                usuario_f_anexo::create([
                    'anexo_id'    => $request->item_id,
                    'user_id'=>auth()->user()->id
                ]);
                break;
            case 'artigo':
                usuario_f_artigo::create([
                    'artigo_id'    => $request->item_id,
                    'user_id'=>auth()->user()->id
                ]);
                break;
            case 'link':
                usuario_f_link::create([
                    'link_id'    => $request->item_id,
                    'user_id'=>auth()->user()->id
                ]);

                break;
            case 'teste':
                usuario_f_teste::create([
                    'teste_id'    => $request->item_id,
                    'user_id'=>auth()->user()->id
                ]);
                break;
            case 'video':
                usuario_f_video::create([
                    'video_id'    => $request->item_id,
                    'user_id'=>auth()->user()->id
                ]);
                break;
        }
        return '200 - success';

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
    public function destroy(Request $request, $id)
    {
        switch ($request->tipo){
            case 'anexo':
                $favorito = usuario_f_anexo::where('user_id', auth()->user()->id)->where('anexo_id', $id)->delete();
                break;
            case 'artigo':
                $favorito = usuario_f_artigo::where('user_id', auth()->user()->id)->where('artigo_id', $id)->delete();
                break;
            case 'link':
                $favorito = usuario_f_link::where('user_id', auth()->user()->id)->where('link_id', $id)->delete();
                break;
            case 'teste':
                $favorito = usuario_f_teste::where('user_id', auth()->user()->id)->where('teste_id', $id)->delete();
                break;
            case 'video':
                $favorito = usuario_f_video::where('user_id', auth()->user()->id)->where('video_id', $id)->delete();
                break;
        }

        return '200 success';
    }

}
