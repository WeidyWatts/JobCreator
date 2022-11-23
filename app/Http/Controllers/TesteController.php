<?php

namespace App\Http\Controllers;

use App\Models\opcao_multi;
use App\Models\questao_multi;
use App\Models\questao_texto;
use App\Models\Teste;
use Illuminate\Http\Request;

class TesteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teste = Teste::paginate(5);
        return view('biblioteca.teste.index', ['testes'=>$teste]);
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
        $teste = Teste::create($request->all());

        if($teste){
            return redirect()->route('teste.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Teste  $teste
     * @return \Illuminate\Http\Response
     */
    public function show(Teste $teste)
    {
        $questoes_multi = questao_multi::with('opcoes')->where('teste_id', '=',$teste->id)->get();
        $questoes = questao_texto::where('teste_id', '=',$teste->id)->get();

        return view('biblioteca.teste.questoes',compact('questoes_multi', 'teste', 'questoes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Teste  $teste
     * @return \Illuminate\Http\Response
     */
    public function edit(Teste $teste)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Teste  $teste
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teste $teste)
    {
        $teste->titulo = $request->titulo;;
        $teste->descricao = $request->descricao;
        $teste->save();
        return redirect()->route('teste.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Teste  $teste
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teste $teste)
    {
        //
    }


    /**
     * Store a new test created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function questaoStore(Request $request)
    {

        if($request->tipo == 2) {

            $add = [];
            $aux = 0;
            $opcao = $request->opcao;

            foreach ($opcao as $op) {
                $auxiliar = 'iscorrect-' . $aux;
                if ($request->$auxiliar == "on") {
                    $add[] = [
                        'opcao' => $op,
                        'iscorrect' => true
                    ];
                } else {

                    $add[] = [
                        'opcao' => $op,
                        'iscorrect' => false
                    ];
                }
                $aux++;
            }

            $questao = questao_multi::create([
                'enunciado' => $request->titulo,
                'teste_id' => $request->teste_id
            ]);


            foreach($add as $ad){
                opcao_multi::create([
                    'opcao' => $ad['opcao'],
                    'is_correct' => $ad['iscorrect'],
                    'questao_id' => $questao->id
                ]);
            }
        }else {
            $questao_textc = questao_texto::create([
                'enunciado' => $request->titulo,
                'resposta'=> $request->opcao[0],
                'teste_id'=> $request->teste_id
            ]);
        }

        return redirect()->route('teste.show',$request->teste_id);
    }
    public function questaoUpdate(Request $request, $id)
    {
        if($request->tipo == 2) {

            $add = [];
            $addnew = [];
            $aux = 0;
            $auxnew = 0;
            $opcao = $request->opcao;
            $opcaonew = $request->opcaonew;

            foreach ($opcao as $key => $value) {

                $auxiliar = 'iscorrect-' . $key;
                if ($request->$auxiliar == "on") {
                    $add[] = [
                        'id' => $key,
                        'opcao' => $value,
                        'iscorrect' => true
                    ];
                } else {

                    $add[] = [
                        'id' => $key,
                        'opcao' => $value,
                        'iscorrect' => false
                    ];
                }
                $aux++;
            }
            if($opcaonew) {
                foreach ($opcaonew as $op) {

                    $auxiliar = 'new_iscorrect-' . $auxnew;
                    if ($request->$auxiliar == "on") {
                        $addnew[] = [

                            'opcao' => $op,
                            'iscorrect' => true
                        ];
                    } else {

                        $addnew[] = [

                            'opcao' => $op,
                            'iscorrect' => false
                        ];
                    }
                    $auxnew++;
                }

                foreach($addnew as $ad){
                    opcao_multi::create([
                        'opcao' => $ad['opcao'],
                        'is_correct' => $ad['iscorrect'],
                        'questao_id' => $id
                    ]);
                }
            }
            $questao = questao_multi::find($id);
            $questao->enunciado = $request->titulo;
            $questao->save();

            foreach($add as $ad){
                $opcao = opcao_multi::find($ad['id']);
                $opcao->opcao = $ad['opcao'];
                $opcao->is_correct = $ad['iscorrect'];
                $opcao->save();
            }



        }else {
            $questao_textc = questao_texto::find($id);
            $questao_textc->enunciado = $request->titulo;
            $questao_textc->resposta = $request->opcao[0];
            $questao_textc->teste_id =$request->teste_id;
            $questao_textc->save();
        }

        return redirect()->route('teste.show',$request->teste_id);
    }

    public function questaoDestroy(Request $request)
    {

        if($request->tipo == 'multi') {
            $questao = questao_multi::find($request->id);
        } else{
            $questao = questao_texto::find($request->id);
        }

        $questao->delete();
        return redirect()->back();
    }

    public function opcaoDestroy($id)
    {
        $opcao = opcao_multi::find($id);
        $opcao->delete();
        return 200;
    }

    public function getSelect2Json() {
        $data = Teste::get();
        $select2 = [];
        foreach ($data as $item) {
            $select2[] = ['id'=>$item->id, 'text' =>$item->titulo];
        }
        return response()->json($select2);
    }

}
