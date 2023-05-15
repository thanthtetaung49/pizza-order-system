<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // location to pizza/cartPage
    public function cartPage()
    {
        $cartdatas = Cart::select('carts.*', 'products.*', 'products.name as product_name', 'carts.id as cart_id')
            ->leftJoin('products', 'products.id', 'carts.product_id')
            ->get();
        // dd($cartdatas->toArray());

        $subTotal = 0;
        $deliFee = 3000;
        foreach ($cartdatas as $cart) {
            $subTotal += $cart->price * $cart->quantity;
        }
        return view('user.cart.cartPage', compact('cartdatas', 'subTotal', 'deliFee'));
    }
}
