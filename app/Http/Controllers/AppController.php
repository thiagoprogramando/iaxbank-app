<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class AppController extends Controller {
    
    public function app() {

        $products = Product::where('status', '1')->get();
        return view('app.app', [
            'products' => $products
        ]);
    }
}
