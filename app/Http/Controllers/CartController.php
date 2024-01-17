<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Auth;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::with(['product.galleries', 'user'])->where('user_id', Auth::user()->id)->get();
        return view('pages.cart', ['carts' => $carts]);
    }

    public function delete($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();
        return redirect()->back();
    }

    public function success()
    {
        return view('pages.success');
    }
}
