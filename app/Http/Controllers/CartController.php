<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    //
    public function cart()
    {
        $cart = session()->get('cart', []);
        return view('frontend.cart.cart', compact('cart'));
    }

    public function add(Product $product)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['qty']++;
        } else {
            $cart[$product->id] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'qty' => 1,
            ];
        }

        session()->put('cart', $cart);
        return back()->with('success', 'Added to cart');
    }

    public function update(Request $request, Product $product)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$product->id])) {
            $cart[$product->id]['qty'] = max(1, (int)$request->qty);
            session()->put('cart', $cart);
        }
        return back();
    }

    public function remove(Product $product)
    {
        $cart = session()->get('cart', []);
        unset($cart[$product->id]);
        session()->put('cart', $cart);
        return back()->with('success', 'Removed from cart');
    }
}
