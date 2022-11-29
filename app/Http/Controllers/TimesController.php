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
                'time_id'=>$time->id
            ]);
        }

        if(isset($request->gerente)) {
            Usuario_time::create([
                'user_id'=>$request->gerente,
                'time_id'=>$time->id
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

    public function getSelect2Json() {
        $data = User::get();
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


}
