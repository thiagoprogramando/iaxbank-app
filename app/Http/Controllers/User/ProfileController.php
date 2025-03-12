<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller {
    
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
}
