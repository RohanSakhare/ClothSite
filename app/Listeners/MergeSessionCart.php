<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use App\Models\CartItem;
use App\Models\Product;

class MergeSessionCart
{
    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        $user = $event->user;
        $sessionCart = session()->get('cart', []);

        foreach ($sessionCart as $prodId => $item) {
            $product = Product::find($prodId);
            if (! $product) continue;

            $existing = CartItem::where('user_id', $user->id)->where('product_id', $prodId)->whereNull('variant_id')->first();
            if ($existing) {
                $existing->update(['quantity' => $existing->quantity + ($item['qty'] ?? 1)]);
            } else {
                CartItem::create([
                    'user_id' => $user->id,
                    'product_id' => $prodId,
                    'name' => $item['name'] ?? $product->name,
                    'price' => $item['price'] ?? $product->price,
                    'quantity' => $item['qty'] ?? 1,
                    'image' => optional($product->images->first())->image,
                ]);
            }
        }

        // clear legacy session cart
        session()->forget('cart');
    }
}
