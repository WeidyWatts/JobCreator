<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Mail\userMail;


class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::paginate(10);
        return view('administracao.usuario.index', ['usuarios'=>$user]);
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
        $password_temporario = $this->generatePassword();

        User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($password_temporario),
            'user_type' => 3,
            'status'    => 0,
            'cargo'     =>$request->cargo,
        ]);

        $mail = Mail::to($request->email,)->send(new userMail($password_temporario, $request->email, $request->name ));

        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    private function generatePassword($qtyCaraceters = 8)
    {

        $smallLetters = str_shuffle('abcdefghijklmnopqrstuvwxyz');
        $capitalLetters = str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ');
        $numbers = (((date('Ymd') / 12) * 24) + mt_rand(800, 9999));
        $numbers .= 1234567890;
        $specialCharacters = str_shuffle('!@#$%*-');
        $characters = $capitalLetters.$smallLetters.$numbers.$specialCharacters;

        $password = substr(str_shuffle($characters), 0, $qtyCaraceters);

        return $password;
    }
}
