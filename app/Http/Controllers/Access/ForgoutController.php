<?php

namespace App\Http\Controllers\Access;

use App\Http\Controllers\Controller;
use App\Mail\Forgout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ForgoutController extends Controller {
    
    public function index($code = null) {

        return view('forgout', [
            'code' => $code
        ]);
    }

    public function generateCode(Request $request) {
        
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.required' => 'O campo e-mail é obrigatório!',
            'email.email'    => 'O e-mail informado não é válido!',
            'email.exists'   => 'Este e-mail não está cadastrado no sistema!',
        ]);

        $user = User::where('email', $request->email)->first();

        $code = Str::upper(Str::random(3)).rand(100, 999);

        DB::table('password_reset_tokens')->where('email', $request->email)->delete();
        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $code,
            'created_at' => Carbon::now(),
        ]);

        $sent = Mail::to($user->email, name: $user->name)->send(new Forgout([
            'fromName'  => env('MAIL_FROM_NAME'),
            'fromEmail' => env('MAIL_FROM_ADDRESS'),
            'toName'    => $user->name,
            'subject'   => 'Redefinição de dados',
            'message'   => $code
        ]));

        if ($sent) {
            return redirect()->back()->with('success', 'Verifique seu email, enviamos os dados de redefinição!');
        }

        return redirect()->back()->with('infor', 'Não foi possivel redefinir os dados, tente novamente mais tarde!');
    }

    public function resetPassword(Request $request) {

        $validator = Validator::make($request->all(), [
            'code'                  => 'required',
            'password'              => 'required|min:6',
        ], [
            'code.required'         => 'O código de redefinição é obrigatório.',
            'password.required'     => 'Informe uma nova senha!',
            'password.min'          => 'A senha deve ter no mínimo 6 caracteres!',
        ]);

        if ($request->password !== $request->passwordconfirm) {
            return redirect()->back()->with('infor', 'Senha não coincidem!');
        }

        $reset = DB::table('password_reset_tokens')->where('token', $request->code)->first();
        if (!$reset) {
            return redirect()->back()->with('infor', 'Código inválido ou expirado!');
        }

        $validUntil = Carbon::parse($reset->created_at)->addDay();
        if (Carbon::now()->greaterThan($validUntil)) {
            return redirect()->back()->with('infor', 'Código expirado, solicite um novo!');
        }

        $user = User::where('email', $reset->email)->first();
        if (!$user) {
            return redirect()->back()->with('infor', 'Não foi possível alterar os dados, tente novamente mais tarde!');
        }

        $user->password = Hash::make($request->password);
        if ($user->save()) {
            DB::table('password_reset_tokens')->where('email', $reset->email)->delete();
            return redirect()->route('login')->with('success', 'Dados alterados com sucesso!');
        }

        return redirect()->back()->with('infor', 'Não foi possível alterar os dados, tente novamente mais tarde!');
    }
}
