<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductVariant;

class ProductVariantController extends Controller
{
    //

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'size' => 'required',
            'color' => 'required',
            'stock' => 'required|integer|min:0',
        ]);

        ProductVariant::create($request->all());

        return back()->with('success', 'Variant added');
    }

    public function destroy(ProductVariant $productVariant)
    {
        $productVariant->delete();

        return back()->with('success', 'Variant deleted');
    }
}
