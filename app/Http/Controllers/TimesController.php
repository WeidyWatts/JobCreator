<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Time;
use App\Models\Usuario_time;

class TimesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $times = Time::with('users')->paginate(6);
        return view('administracao.times.index',['times'=>$times]);
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

        $time = Time::create([
            'nome'=> $request->nome
        ]);

        foreach ($request->membros as $membro) {
            Usuario_time::create([
                'user_id'=>$membro,
                'time_id'=>$time->id,
                'gerente'   =>0
            ]);
        }

        if(isset($request->gerente)) {
            Usuario_time::create([
                'user_id'   =>$request->gerente,
                'time_id'   =>$time->id,
                'gerente'   =>1
            ]);
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
    public function update(Request $request, Time $time)
    {
        //dd($request);
        $time->nome = $request->nome;
        $time->save();


        $atual = Usuario_time::where('time_id', $time->id)->get();
        $novo = $request->membros;
        if(isset($atual)) {
            foreach ($atual as $item) {
                if(isset($novo)) {
                    foreach ($novo as $k => $v) {
                        if ($item->user_id == $v) {
                            unset($novo[$k]);
                        }
                    }
                }
            }
        }
        if(isset($novo)) {
            foreach ($novo as $user) {
                Usuario_time::create([
                    'user_id' => $user,
                    'time_id' => $time->id,
                    'gerente' => 0
                ]);
            }
        }

        if(isset($request->gerente)){
          $gerente_atual =  Usuario_time::where('time_id', $time->id)->where('gerente', '1')->first();
          if($gerente_atual) {
              $gerente_atual->delete();
          }
            Usuario_time::create([
                'user_id'   =>$request->gerente,
                'time_id'   =>$time->id,
                'gerente'   =>1
            ]);
        }
        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Time $time)
    {
        $time->delete();
        return redirect()->back();

    }

    public function getSelect2Json() {
        $data = User::where('cargo', '<>', 'gerente')->get();
        foreach ($data as $item) {
            $select2[] = ['id'=>$item->id, 'text' =>$item->name];
        }
        return response()->json($select2);
    }
    public function getSelect2JsonAll() {
        $data = User::where('cargo', 'gerente')->get();
        foreach ($data as $item) {
            $select2[] = ['id'=>$item->id, 'text' =>$item->name];
        }
        return response()->json($select2);
    }


    public function getSelect2JsonGerente() {
        $data = User::where('cargo', 'gerente')->get();
        $select2 = [];

        foreach ($data as $item) {
            $select2[] = ['id'=>$item->id, 'text' =>$item->name];
        }
        return response()->json($select2);
    }

    public function UserRemove($user_id, $time_id){
        $ut = Usuario_time::where('user_id', $user_id)->where('time_id', $time_id)->first();
        $ut->delete();
        return 'Success';
    }

    public function TimesToSelect2() {
        $data = Time::get();
        $select2 = [];

        foreach ($data as $item) {
            $select2[] = ['id'=>$item->id, 'text' =>$item->nome];
        }
        return response()->json($select2);
    }


}
