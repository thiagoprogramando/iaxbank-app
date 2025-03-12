<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductPackage;
use Illuminate\Http\Request;

class PackageController extends Controller {
    
    public function index(Request $request, $product) {

        $product = Product::where('uuid', $product)->first();
        if (!$product) {
            return redirect()->back()->with('infor', 'Produto não localizado!');
        }

        $query = ProductPackage::orderBy('name', 'desc');
        if (!empty($request->name)) {
            $query->where('name', 'LIKE', '%'.$request->name.'%');
        }

        if (!empty($request->time)) {
            $query->where('time', $request->time);
        }

        $packages = $query->where('product_id', $product->id)->paginate(10);
        return view('app.Product.packages', [
            'packages' => $packages,
            'product'  => $product
        ]);
    }

    public function store(Request $request) {

        $product = Product::where('uuid', $request->product)->first();
        if (!$product) {
            return redirect()->back()->with('infor', 'Produto não localizado!');
        }

        $package                        = new ProductPackage();
        $package->product_id            = $product->id;
        $package->name                  = $request->name;
        $package->description           = $request->description;
        $package->value                 = $this->formatValue($request->value);
        $package->performance           = $this->formatPercentage($request->performance);
        $package->binary_left_percent   = $this->formatPercentage($request->binary_left_percent);
        $package->binary_right_percent  = $this->formatPercentage($request->binary_right_percent);
        $package->time                  = $request->time;
        $package->status                = $request->status;
        if ($package->save()) {
            return redirect()->route('packages', ['product' => $product->uuid])->with('success', 'Pacote cadastrado com sucesso!');
        }

        return redirect()->back()->with('error', 'Não foi possível concluir a operação, tente novamente mais tarde!');
    }

    public function update(Request $request) {

        $product = Product::where('uuid', $request->product)->first();
        if (!$product) {
            return redirect()->back()->with('infor', 'Produto não localizado!');
        }

        $package                = ProductPackage::find($request->package_id);
        $package->name          = $request->name;
        $package->description   = $request->description;
        $package->value         = $this->formatValue($request->value);
        $package->performance   = $this->formatPercentage($request->performance);
        $package->time          = $request->time;
        $package->status        = $request->status;
        if ($package->save()) {
            return redirect()->route('packages', ['product' => $product->uuid])->with('success', 'Pacote alterado com sucesso!');
        }

        return redirect()->back()->with('error', 'Não foi possível concluir a operação, tente novamente mais tarde!');
    }

    public function delete(Request $request) {

        $package = ProductPackage::find($request->id);
        if (!$package) {
            return redirect()->back()->with('infor', 'Não foi possível encontrar o Pacote, verifique os dados e tente novamente!');
        }

        if ($package->delete()) {
            return redirect()->back()->with('success', 'Pacote excluído com sucesso!');
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
