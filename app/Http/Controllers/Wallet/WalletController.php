<?php

namespace App\Http\Controllers\Wallet;

use App\Http\Controllers\Controller;
use App\Models\Investiment;
use App\Models\Transactions;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WalletController extends Controller {
    
    public function index(Request $request, $uuid) {

        $user = User::where('uuid', $uuid)->first();
        if (!$user) {
            return redirect()->back()->with('error', 'Dados da Carteira não encontrados!');
        }

        $transfers = Transactions::where('from_id', Auth::user()->id)
                            ->orWhere('to_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(30);

        return view('app.Wallet.wallet', [
            'user'      => $user,
            'transfers' => $transfers
        ]);
    }

    public function walletInvestment(Request $request, $uuid) {

        $user = User::where('uuid', $uuid)->first();
        if (!$user) {
            return redirect()->back()->with('error', 'Dados da Carteira não encontrados!');
        }

        $investiments = Investiment::where('status', 1)->where('user_id', $user->id)->paginate(30);
        return view('app.Wallet.wallet-investment', [
            'user'          => $user,
            'investiments'  => $investiments
        ]);
    }
}
