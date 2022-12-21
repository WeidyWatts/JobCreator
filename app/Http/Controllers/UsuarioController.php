<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\Colaborador_Empresa;
use App\Mail\userMail;
use App\Mail\CentralAtendimentoMail;



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

       $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($password_temporario),
            'user_type' => 3,
            'status'    => 0,
            'cargo'     =>$request->cargo,
        ]);

        if(auth()->user()->user_type == 2) {
            $empresa = Empresa::where('user_id',auth()->user()->id)->first();

            Colaborador_Empresa::create([
                'user_id'=> $user->id,
                'empresa_id'=>$empresa->id
            ]);

        }

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
        $file = $request->image;
        $name = uniqid(date('HisYmd'));
        $extension = $file->getClientOriginalExtension();
        $nameFile = "{$name}.{$extension}";
        $upload = $file->storeAs('public/user', $nameFile);
        $usuario = User::find(auth()->user()->id);
        $usuario->image = $nameFile;
        $usuario->name = $request->name;
        $usuario->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->back();
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


    public function centralAtendimento(Request $request){

       $mensagem = $request->mensagem;
       $email = auth()->user()->email;
       $name = auth()->user()->name;
       $assunto = $request->assunto;

       $mail = Mail::to('relacionamento@jobcreators.com.br')->send(new CentralAtendimentoMail($mensagem, $email, $name, $assunto));

       return redirect()->back()->with('success', 'Obrigado por sua mensagem , em breve retornaremos! fique de olho no seu e-mail.');


    }
}
