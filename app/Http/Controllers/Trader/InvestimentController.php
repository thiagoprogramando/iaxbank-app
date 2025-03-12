<?php

namespace App\Http\Controllers\Trader;

use App\Http\Controllers\Controller;
use App\Models\Investiment;
use App\Models\Product;
use App\Models\ProductPackage;
use App\Models\User;
use Illuminate\Http\Request;

class InvestimentController extends Controller {
    
    public function index(Request $request, $product) {

        $product = Product::where('uuid', $product)->first();
        if (!$product) {
            return redirect()->back()->with('infor', 'Produto não encontrado!');
        }

        $query = Investiment::where('product_id', $product->id);
        if (!empty($request->users) && is_array($request->users)) {
            $query->whereIn('user_id', $request->users);
        }        

        if (!empty($request->package_id)) {
            $query->where('package_id', $request->package_id);
        }

        if (!empty($request->status)) {
            $query->where('status', $request->status);
        }

        $packages = ProductPackage::where('product_id', $product->id)->get();
        $users    = User::orderBy('name', 'desc')->get();

        return view('app.Product.investiments', [
            'investiments' => $query->paginate(30),
            'packages'     => $packages,
            'users'        => $users,
            'product'      => $product
        ]);
    }

    public function update(Request $request) {

        $investiment = Investiment::find($request->investiment_id);
        if (!$investiment) {
            return redirect()->back()->with('infor', 'Não foi possível encontrar o Investimento, verifique os dados e tente novamente!');
        }

        if (!empty($request->amount)) {
            $investiment->amount = $this->formatValue($request->amount);
        }

        if (!empty($request->profit_percent)) {
            $investiment->profit_percent = $this->formatPercentage($request->profit_percent);
        }

        if (!empty($request->status)) {
            $investiment->status = $request->status;
        }

        if ($investiment->save()) {
            return redirect()->back()->with('success', 'Investimento atualizado com sucesso!');
        }

        return redirect()->back()->with('error', 'Não foi possível atualizar o Investimento, verifique os dados e tente novamente!');
    }

    public function delete(Request $request) {

        $investiment = Investiment::find($request->id);
        if (!$investiment) {
            return redirect()->back()->with('infor', 'Não foi possível encontrar o Investimento, verifique os dados e tente novamente!');
        }

        if ($investiment->delete()) {
            return redirect()->back()->with('success', 'Investimento excluído com sucesso!');
        }
    }

    private function formatValue($valor) {
        
        $valor = preg_replace('/[^0-9,]/', '', $valor);
        $valor = str_replace(',', '.', $valor);
        $valorFloat = floatval($valor);
    
        return number_format($valorFloat, 2, '.', '');
    }

    private function formatPercentage($valor) {
        
        $valor = preg_replace('/[^0-9,]/', '', $valor);
        $valor = str_replace(',', '.', $valor);
        $valorFloat = floatval($valor);
    
        return number_format($valorFloat, 2, '.', '');
    }
}
