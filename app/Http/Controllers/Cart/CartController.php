<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Models\Investiment;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller {
    
    public function index(Request $request) {

        $query = Investiment::where('user_id', Auth::id())->with('product', 'package');
        if ($request->has('status') && $request->status !== null) {
            $query->where('status', $request->status);
        }

        $investments = $query->get();
        return view('app.Cart.cart', [
            'investiments' => $investments
        ]);
    }

}
