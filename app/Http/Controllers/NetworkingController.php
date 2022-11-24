<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Networking;


class NetworkingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Networking::max('id');
        return view('material_de_apoio.networking.index', ['networking'=>$data]);
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
        $file = $request->networking;
        $name = uniqid(date('HisYmd'));
        $extension = $file->getClientOriginalExtension();
        $nameFile = "{$name}.{$extension}";
        $upload = $file->storeAs('networking', $nameFile);
        if ($upload) {
            $networking = Networking::create([
                'networking' => $nameFile
            ]);
            if($networking) {
                return redirect()->route('networking.index');
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
        $networking = Networking::find($fileName);
        $file_path = storage_path('app/networking/'.$networking->networking);
        return response()->download($file_path);
    }
}
