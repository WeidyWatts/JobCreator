<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Journey;
use App\Models\Journey_Usuario;
use App\Models\Usuario_time;
use App\Models\Notificacao;
use App\Models\Modulo;

class JourneyRegistradaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $journey = Journey::with('users')->paginate(5);

        return view('administracao.journey-registrada.index', ['journeys'=>$journey]);
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


        if(isset($request->usuarios)) {
            foreach ($request->usuarios as $usuario) {

                $ju = Journey_Usuario::create([
                    'journey_id' => $request->journey_id,
                    'user_id' => $usuario,
                    'percentual_concluido' => 0
                ]);
                Notificacao::create([
                    'notificacao' => 'Uma Nova Journey foi adicionada para você!',
                    'user_id' => $usuario,
                    'status' => 0
                ]);
            }
        }
//inclusao dinamica de times e Journey
        if(isset($request->times)) {
            foreach ($request->times as $time) {
                $ut = Usuario_time::where('time_id', $time)->get();
                foreach($ut as $u) {
                    Journey_Usuario::create([
                        'journey_id'=>$request->journey_id,
                        'user_id'=>$u->user_id,
                        'percentual_concluido'=> 0
                    ]);
                    Notificacao::create([
                        'notificacao'=> 'Uma Nova Journey foi adicionada para você!',
                        'user_id'=> $u->user_id,
                        'status'=> 0
                    ]);
                }
            }
        }

        return redirect()->back();
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
        $modulos = Modulo::where('journey_id', $request->journey_id)->get();
        $modulos = count($modulos);

        $percent = 100/$modulos;

        $ju = Journey_Usuario::where('journey_id', $request->journey_id)->where('user_id', $id)->get();

        if($ju) {
            $ju->percentual_concluido +=  $percent;
            $ju->save();
        }


        return redirect()->route('journey.index');



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
}
