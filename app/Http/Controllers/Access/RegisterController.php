<?php

namespace App\Http\Controllers\Access;

use App\Http\Controllers\Controller;

use App\Models\User;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class RegisterController extends Controller {
    
    public function register($indicator = null) {

        if (Auth::check()) {
            return redirect()->route('app');
        }

        return view('register', [
            'indicator' => $indicator
        ]);
    }

    public function registrer(Request $request) {

        $request->merge([
            'terms'     => $request->has('terms') ? '1' : '0',
            'cpfcnpj'   => preg_replace('/\D/', '', $request->cpfcnpj),
        ]);

        $request->validate([
            'sponsor_id' => 'required|exists:users,uuid',
            'name'       => 'required',
            'email'      => 'required|unique:users,email',
            'password'   => 'required',
            'cpfcnpj'    => 'required',
            'terms'      => 'accepted',
        ], [
            'sponsor_id.required'   => 'É necessário um INDICADOR para cadastrar-se!',
            'name.required'         => 'É necessário informar o seu Nome!',
            'email.unique'          => 'Esse email já está em uso!',
            'name.password'         => 'É necessário informar uma Senha!',
            'cpfcnpj.required'      => 'É necessário informar um CPF ou CNPJ!',
            'terms.accepted'        => 'É necessário aceitar os termos de uso!',
        ]);

        $sponsor = User::where('uuid', $request->sponsor_id)->first();
        if (!$sponsor) {
            return redirect()->back()->with('error', 'É necessário um INDICADOR para cadastrar-se!');
        }

        if ($sponsor->binary_left_id && $sponsor->binary_right_id) {
            $position = $this->findBestPlacement($sponsor->id);
        } else {
            $position = [
                'sponsor_id' => $sponsor->id,
                'position'   => !$sponsor->binary_left_id ? 1 : 2,
            ];
        } 

        if (!$position) {
            return redirect()->back()->with('error', 'INDICATOR não disponpivel!');
        }

        $user = new User();
        $user->uuid         = Str::uuid();
        $user->sponsor_id   = $sponsor->id;
        $user->position     = $position['position'];
        $user->name         = $request->name;
        $user->cpfcnpj      = preg_replace('/\D/', '', $request->cpfcnpj);
        $user->email        = $request->email;
        $user->password     = bcrypt($request->password);
        if ($user->save()) {
            
            if ($user->position == 1) {
                User::where('id', $position['sponsor_id'])->update(['binary_left_id' => $user->id]);
            } else {
                User::where('id', $position['sponsor_id'])->update(['binary_right_id' => $user->id]);
            }
    
            if (Auth::attempt($request->only(['email', 'password']))) {
                return redirect()->route('app');
            } else {
                return redirect()->route('login')->with('success', 'Bem-vindo(a)! Faça Login para acessar!');
            }
        }

        return redirect()->back()->with('error', 'Não foi possível realizar essa ação, tente novamente mais tarde!');
    }

    private function findBestPlacement($sponsor_id) {

        $queue = [$sponsor_id];
        while (!empty($queue)) {

            $current_id  = array_shift($queue);

            $currentUser = User::find($current_id);
            if (!$currentUser) {
                continue;
            }

            if (!$currentUser->binary_left_id) {
                return ['sponsor_id' => $currentUser->id, 'position' => 1];
            }

            if (!$currentUser->binary_right_id) {
                return ['sponsor_id' => $currentUser->id, 'position' => 2];
            }

            $queue[] = $currentUser->binary_left_id;
            $queue[] = $currentUser->binary_right_id;
        }

        return null;
    }
}
