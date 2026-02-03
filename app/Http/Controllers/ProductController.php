<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;

class ProductController extends Controller
{
    //
    public function index()
    {
        $products = Product::with('category')->latest()->get();
        return view('frontend/products/products', compact('products'));
    }

    public function category(Category $category)
    {
        $products = $category->products()->latest()->get();
        return view('frontend/products/products', compact('products', 'category'));
    }

    public function show(Product $product)
    {
        $product->load([
            'category',
            'images' => function ($query) {
                $query->orderBy('position');
            }
        ]);

        return view('frontend.products.show', compact('product'));
    }
}
