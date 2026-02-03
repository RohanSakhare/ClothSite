<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\CartItem;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    // show cart items (DB-backed)
    public function cart()
    {
        $items = CartItem::ownerQuery()->with(['product', 'variant'])->get();
        return view('frontend.cart.cart', ['cart' => $items]);
    }

    // add product (with optional variant)
    public function add(Request $request, Product $product)
    {
        $request->validate([
            'variant_id' => 'nullable|exists:product_variants,id',
            'quantity' => 'nullable|integer|min:1',
        ]);

        $variant = null;
        if ($request->filled('variant_id')) {
            $variant = ProductVariant::findOrFail($request->variant_id);
            // ensure variant belongs to product
            if ($variant->product_id !== $product->id) {
                return back()->with('error', 'Invalid variant selected');
            }
        }

        $owner = auth()->check() ? ['user_id' => auth()->id()] : ['session_id' => session()->getId()];
        $variantId = $variant ? $variant->id : null;

        // check for existing item
        $existing = CartItem::where('product_id', $product->id)
            ->where('variant_id', $variantId)
            ->where(function ($q) use ($owner) {
                if (isset($owner['user_id'])) {
                    $q->where('user_id', $owner['user_id']);
                } else {
                    $q->where('session_id', $owner['session_id']);
                }
            })->first();

        $qtyToAdd = max(1, (int) $request->input('quantity', 1));

        // determine available stock
        $availableStock = $variant ? $variant->stock : ($product->stock ?? 0);

        if ($existing) {
            $newQty = min($existing->quantity + $qtyToAdd, $availableStock);
            $existing->update(['quantity' => $newQty]);
        } else {
            $data = array_merge($owner, [
                'product_id' => $product->id,
                'variant_id' => $variantId,
                'name' => $product->name,
                'price' => $product->price,
                'size' => $variant ? $variant->size : null,
                'color' => $variant ? $variant->color : null,
                'quantity' => min($qtyToAdd, $availableStock),
                'image' => optional($product->images->first())->image,
                'stock' => $availableStock,
            ]);

            CartItem::create($data);
        }

        return back()->with('success', 'Added to cart');
    }

    // update cart item quantity (by CartItem)
    public function update(Request $request, CartItem $cartItem)
    {
        $request->validate(['qty' => 'required|integer|min:1']);

        // ensure ownership
        if (! $this->isOwner($cartItem)) {
            abort(403);
        }

        $newQty = (int) $request->qty;
        $available = $cartItem->variant ? $cartItem->variant->stock : ($cartItem->product->stock ?? 0);
        $clampedQty = min($newQty, $available);
        $cartItem->update(['quantity' => $clampedQty]);

        // Prepare JSON response for AJAX updates
        $item_total = $cartItem->price * $cartItem->quantity;
            $grand_total = (float) CartItem::ownerQuery()->sum(DB::raw('price * quantity'));

        $response = [
            'quantity' => $cartItem->quantity,
            'item_total' => (float) $item_total,
            'grand_total' => (float) $grand_total,
        ];

        if ($clampedQty < $newQty) {
            $response['warning'] = "Quantity reduced to available stock ({$available}).";
        }

        if ($request->expectsJson() || $request->ajax() || $request->header('Accept') === 'application/json') {
            return response()->json($response);
        }

        return back()->with('success', 'Cart updated');
    }

    // Apply bulk quantity changes (items: [{id, quantity}, ...])
    public function apply(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|integer|exists:cart_items,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        $results = [];
        $warnings = [];

        foreach ($request->input('items', []) as $it) {
            $id = (int) ($it['id'] ?? 0);
            $qty = (int) ($it['quantity'] ?? 1);

            $cartItem = CartItem::findOrFail($id);

            if (! $this->isOwner($cartItem)) {
                abort(403);
            }

            $available = $cartItem->variant ? $cartItem->variant->stock : ($cartItem->product->stock ?? 0);
            $clamped = false;
            $finalQty = $qty;

            if ($available && $qty > $available) {
                $finalQty = $available;
                $clamped = true;
                $warnings[] = "Quantity for item {$cartItem->name} reduced to available stock ({$available}).";
            }

            $cartItem->update(['quantity' => $finalQty]);

            $results[] = [
                'id' => $cartItem->id,
                'quantity' => $cartItem->quantity,
                'total' => (float) ($cartItem->quantity * $cartItem->price),
                'clamped' => $clamped,
                'available' => $available,
            ];
        }

        $grand = (float) CartItem::ownerQuery()->sum(DB::raw('price * quantity'));

        return response()->json(['success' => true, 'items' => $results, 'grand_total' => $grand, 'warnings' => $warnings]);
    }

    // remove cart item
    public function remove(CartItem $cartItem)
    {
        if (! $this->isOwner($cartItem)) {
            abort(403);
        }

        $cartItem->delete();
        return back()->with('success', 'Removed from cart');
    }

    protected function isOwner(CartItem $item)
    {
        if (auth()->check()) {
            return $item->user_id === auth()->id();
        }
        return $item->session_id === session()->getId();
    }

    // helper: migrate legacy session cart array into DB for current user
    public function migrateSessionCartToUser()
    {
        if (! auth()->check()) return;

        $sessionCart = session()->get('cart', []);
        foreach ($sessionCart as $prodId => $item) {
            $product = Product::find($prodId);
            if (! $product) continue;

            $existing = CartItem::where('user_id', auth()->id())->where('product_id', $prodId)->whereNull('variant_id')->first();
            if ($existing) {
                $existing->update(['quantity' => $existing->quantity + $item['qty']]);
            } else {
                CartItem::create([
                    'user_id' => auth()->id(),
                    'product_id' => $prodId,
                    'name' => $item['name'] ?? $product->name,
                    'price' => $item['price'] ?? $product->price,
                    'quantity' => $item['qty'] ?? 1,
                    'image' => optional($product->images->first())->image,
                ]);
            }
        }

        session()->forget('cart');
    }
}
