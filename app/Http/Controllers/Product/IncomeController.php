<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;

use App\Models\Product;
use App\Models\ProductIncome;

use Illuminate\Http\Request;

class IncomeController extends Controller {
    
    public function index(Request $request, $product) {

        $product = Product::where('uuid', $product)->first();
        if (!$product) {
            return redirect()->back()->with('infor', 'Produto não localizado!');
        }

        $query = ProductIncome::orderBy('executed_at', 'desc');
        if (!empty($request->status)) {
            $query->where('status', $request->status);
        }

        if (!empty($request->package_id)) {
            $query->where('package_id', $request->package_id);
        }

        if (!empty($request->executed_at)) {
            $query->whereDate('executed_at', $request->executed_at);
        }

        if (!empty($request->created_at)) {
            $query->whereDate('created_at', $request->created_at);
        }

        $incomes = $query->where('product_id', $product->id)->paginate(30);
        return view('app.Product.incomes', [
            'incomes' => $incomes,
            'product' => $product
        ]);
    }

}
