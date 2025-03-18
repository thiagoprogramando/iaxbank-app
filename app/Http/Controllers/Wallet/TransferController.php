<?php

namespace App\Http\Controllers\Wallet;

use App\Http\Controllers\Controller;
use App\Models\Transactions;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TransferController extends Controller {
    
    public function index(Request $request) {
        
        if ($request->key) {

            $user = $this->validateUser($request->key);
            if (!$user) {
                return redirect()->back()->with('error', 'Nenhuma conta associada a chave informada!');
            }
            
            return view('app.Wallet.transfer', [
                'to' => $user
            ]);
        }

        return view('app.Wallet.transfer');
    }

    public function transferSend(Request $request) {

        $request->validate([
            'password'  => 'required',
            'value'     => 'required|min:0.01',
            'to'        => 'required|exists:users,uuid'
        ], [
            'password.required' => 'Informe sua senha!',
            'value.required'    => 'Informe um valor!',
            'value.min'         => 'Informe um valor!',
            'to.required'       => 'Informe um destinatário!',
            'to.exists'         => 'Nenhuma conta associada para essa chave!',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->password, $user->password)) {
            return redirect()->back()->with('error', 'Senha inválida!');
        }

        if (empty($request->value)) {
            return redirect()->back()->with('infor', 'Informe um valor!');
        }

        $value = $this->formatValue($request->value);
        if ($user->wallet < $value) {
            return redirect()->back()->with('error', 'Saldo insuficiente!');
        }

        $to = User::where('uuid', $request->to)->first();
        if (!$to) {
            return redirect()->back()->with('infor', 'Nenhuma conta associada para essa chave!');
        }

        DB::beginTransaction();
        try {
            $user->wallet -= $value;
            $to->wallet += $value;
            $user->save();
            $to->save();

            Transactions::create([
                'uuid'    => Str::uuid(),
                'from_id' => $user->id,
                'to_id'   => $to->id,
                'value'   => $this->formatValue($request->value),
                'type'    => 1,
                'status'  => 1
            ]);

            DB::commit();
            return redirect()->route('wallet', ['uuid' => $user->uuid])->with('success', 'Transferência concluída com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Erro ao processar a transferência. Tente novamente.');
        }

        return redirect()->back()->with('error', 'Não foi possível concluir a transferência!');
    }

    private function validateUser($key) {

        if (filter_var($key, FILTER_VALIDATE_EMAIL)) {
            return User::where('email', $key)->first() ?? false;
        }

        if (preg_match('/^[0-9a-fA-F]{8}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{12}$/', $key)) {
            return User::where('uuid', $key)->first() ?? false;
        }

        $key = preg_replace('/\D/', '', $key);
        return User::where('cpfcnpj', $key)->first() ?? false;
    } 
    
    private function formatValue($value) {
        
        $value = preg_replace('/[^0-9,]/', '', $value);
        $value = str_replace(',', '.', $value);
        $valueFloat = floatval($value);
    
        return number_format($valueFloat, 2, '.', '');
    }
}
