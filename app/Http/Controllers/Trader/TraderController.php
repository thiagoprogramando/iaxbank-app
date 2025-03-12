<?php

namespace App\Http\Controllers\Trader;

use App\Http\Controllers\Controller;
use App\Models\Investiment;
use App\Models\Product;
use App\Models\ProductPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TraderController extends Controller {
    
    public function index($product) {

        $product = Product::where('uuid', $product)->first();
        if (!$product || $product->status !== 1) {
            return redirect()->back()->with('infor', 'Produto indisponível!');
        }

        $packages = $product->packages()->get();
        return view('app.Trader.trader', [
            'product'   => $product,
            'packages'  => $packages
        ]);
    }

    public function createInvestiment(Request $request) {

        $product = Product::where('uuid', $request->product)->first();
        if (!$product || $product->status !== 1) {
            return redirect()->back()->with('infor', 'Produto indisponível!');
        }

        $package = ProductPackage::where('id', $request->package)->first();
        if (!$package || $package->status !== 1) {
            return redirect()->back()->with('infor', 'Pacote indisponível!');
        }

        if (!Hash::check($request->password, Auth::user()->password)) {
            return redirect()->back()->with('infor', 'Senha inválida, tente novamente!');
        }

        $investiment                    = new Investiment();
        $investiment->uuid              = Str::uuid();
        $investiment->user_id           = Auth::user()->id;
        $investiment->product_id        = $product->id;
        $investiment->package_id        = $package->id;
        $investiment->amount            = $package->value;
        $investiment->profit_percent    = $package->performance;
        if ($investiment->save()) {
            return redirect()->back()->with('success', 'Pacote comprado com sucesso!');
        }

        return redirect()->back()->with('error', 'Não foi possível concluir a operação, tente novamente mais tarde!');
    }
}
