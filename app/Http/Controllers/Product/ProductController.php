<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;

use App\Models\Product;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller {
    
    public function index(Request $request) {

        $query = Product::orderBy('name', 'desc');

        if (!empty($request->name)) {
            $query->where('name', 'LIKE', '%'.$request->name.'%');
        }

        if (!empty($request->description)) {
            $query->where('description', 'LIKE', '%'.$request->description.'%');
        }

        if (!empty($request->status)) {
            $query->where('status', $request->status);
        }

        $products = $query->paginate(10);
        return view('app.Product.products', [
            'products' => $products
        ]);
    }

    public function show($uuid) {

        $product = Product::where('uuid', $uuid)->first();
        if (!$product) {
            return redirect()->back()->with('infor', 'Não foi possível encontrar o Produto, verifique os dados e tente novamente!');
        }

        return view('app.Product.update-product', [
            'product' => $product
        ]);
    }

    public function create() {

        return view('app.Product.create-product');
    }

    public function store(Request $request) {

        $product                = new Product();
        $product->uuid          = Str::uuid();
        $product->user_id       = Auth::user()->id;
        $product->name          = $request->name;
        $product->acronym       = $request->acronym;
        $product->description   = $request->description;
        $product->value         = $this->formatValue($request->value);
        $product->performance   = $this->formatPercentage($request->performance);
        $product->status        = $request->status;

        if ($request->hasFile('photo')) {
            $filename   = uniqid() . '.' . $request->file('photo')->getClientOriginalExtension();
            $path       = $request->file('photo')->storeAs('product-icons', $filename, 'public');
            
            $product->photo = $path;
        }        

        if ($product->save()) {
            return redirect()->route('product-show', ['uuid' => $product->uuid])->with('success', 'Produto cadastro com sucesso!');
        }

        return redirect()->back()->with('error', 'Não foi possível criar o Produto, verifique os dados e tente novamente!');
    }

    public function update(Request $request, $id) {

        $product = Product::find($id);
        if (!$product) {
            return redirect()->back()->with('infor', 'Não foi possível encontrar o Produto, verifique os dados e tente novamente!');
        }

        if (!empty($request->name)) {
            $product->name = $request->name;
        }

        if (!empty($request->acronym)) {
            $product->acronym = $request->acronym;
        }

        if (!empty($request->description)) {
            $product->description = $request->description;
        }

        if (!empty($request->value)) {
            $product->value = $this->formatValue($request->value);
        }
        
        if (!empty($request->performance)) {
            $product->performance = $this->formatPercentage($request->performance);
        }

        if (!empty($request->time)) {
            $product->time = $request->time;
        }
        
        if (!empty($request->status)) {
            $product->status = $request->status;
        }

        if ($request->hasFile('photo')) {

            if ($product->photo) {
                Storage::disk('public')->delete($product->photo);
            }

            $filename   = uniqid() . '.' . $request->file('photo')->getClientOriginalExtension();
            $path       = $request->file('photo')->storeAs('product-icons', $filename, 'public');
            
            $product->photo = $path;
        }    
        
        if ($product->save()) {
            return redirect()->back()->with('success', 'Produto atualizado com sucesso!');
        }

        return redirect()->back()->with('error', 'Não foi possível criar o Produto, verifique os dados e tente novamente!');
    }

    public function delete(Request $request, $id) {

        $product = Product::find($id);
        if (!$product) {
            return redirect()->back()->with('infor', 'Não foi possível encontrar o Produto, verifique os dados e tente novamente!');
        }

        if ($product->uuid !== $request->uuid) {
            return redirect()->back()->with('infor', 'Não foi possível excluir o Produto, verifique os dados e tente novamente!');
        }

        if ($product->delete()) {
            return redirect()->back()->with('success', 'Produto excluído com sucesso!');
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
