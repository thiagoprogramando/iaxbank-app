<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller {

    public function index($uuid) {
        
        $user = User::where('uuid', $uuid)->first();
        if (!$user) {
            return redirect()->back()->with('infor', 'Dados não encontrados!');
        }

        if ((Auth::user()->id !== $user->id) && (Auth::user()->type !== 1)) {
            return redirect()->back()->with('infor', 'Acesso negado!');
        }

        return view('app.User.profile', [
            'user' => $user
        ]);
    }
    
    public function users(Request $request) {

        $query = User::orderBy('name', 'desc');
        if (!empty($request->name)) {
            $query->where('name', 'LIKE', '%'.$request->name.'%');
        }

        if (!empty($request->cpfcnpj)) {
            $query->where('cpfcnpj', $request->cpfcnpj);
        }

        if (!empty($request->email)) {
            $query->where('email', $request->email);
        }

        if (!empty($request->type)) {
            $query->where('type', $request->type);
        }

        return view('app.User.list-users', [
            'users' => $query->paginate(30),
        ]);
    }

    public function update(Request $request, $uuid) {

        $user = User::where('uuid', $uuid)->first();
        if (!$user) {
            return redirect()->back()->with('infor', 'Não foi possível localizar o usuário!');
        }

        if (!empty($request->name)) {
            $user->name = $request->name;
        }

        if (!empty($request->phone)) {
            $user->phone = preg_replace('/\D/', '', $request->phone);
        }

        if (!empty($request->email)) {
            $user->email = $request->email;
        }

        if (!empty($request->cpfcnpj)) {
            $user->cpfcnpj = preg_replace('/\D/', '', $request->cpfcnpj);
        }

        if (!empty($request->type)) {
            $user->type = $request->type;
        }

        if (!empty($request->wallet)) {
            $user->wallet = $this->formatValue($request->wallet);
        }

        if (!empty($request->wallet_accumulated)) {
            $user->wallet_accumulated = $this->formatValue($request->wallet_accumulated);
        }

        if($request->hasFile('photo')) {

            if ($user->photo) {
                Storage::disk('public')->delete($user->photo);
            }

            $path = $request->file('photo')->store('profile-photos', 'public');
            $user->photo = $path;
        }

        if ($user->save()) {
            return redirect()->back()->with('success', 'Dados alterados com sucesso!');
        }

        return redirect()->back()->with('infor', 'Não foi possível alterar os dados!');
    }

    public function delete(Request $request, $uuid) {

        if (empty($request->confirm)) {
            return redirect()->back()->with('infor', 'Por favor, confirme a exclusão da conta!');
        }

        $user = User::where('uuid', $uuid)->first();
        if (!$user) {
            return redirect()->back()->with('infor', 'Não foi possível localizar o usuário!');
        }

        if (($user->uuid == $request->uuid) && $user->delete()) {
            return redirect()->back()->with('success', 'Usuário excluído com sucesso!');
        }

        return redirect()->back()->with('error', 'Não foi possível excluir o usuário!');
    }

    private function formatValue($valor) {
        
        $valor = preg_replace('/[^0-9,]/', '', $valor);
        $valor = str_replace(',', '.', $valor);
        $valorFloat = floatval($valor);
    
        return number_format($valorFloat, 2, '.', '');
    }
}
