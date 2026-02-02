<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

use App\Models\ProductImage;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::latest()->get();
        return view('dashboard.products.products', compact('products'));
    }
    public function data()
    {
        $products = Product::query();

        return DataTables::of($products)
            ->addIndexColumn()

            ->addColumn('image', function ($row) {
                if ($row->image && file_exists(public_path('storage/' . $row->image))) {
                    return '<img src="' . asset('storage/' . $row->image) . '" class="product-thumb">';
                }
                return '<span class="text-muted">No Image</span>';
            })

            ->addColumn('status', function ($product) {
                return $product->status
                    ? '<span class="badge bg-success">Active</span>'
                    : '<span class="badge bg-danger">Inactive</span>';
            })

            ->addColumn('action', function ($row) {
                return '
        <div class="d-flex gap-2">
            <a href="' . route('admin.products.edit', $row->id) . '"
               class="btn btn-sm btn-warning px-3">
                Edit
            </a>

             <form action="' . route('admin.products.destroy', $row->id) . '"
                  method="POST"
                  class="delete-form">
                ' . csrf_field() . method_field('DELETE') . '
                <button type="submit" class="btn btn-sm btn-danger" onclick="confirmDelete(' . $row->id . ')">
                    Delete
                </button>
            </form>
        </div>
    ';
            })


            ->rawColumns(['image', 'status', 'action'])
            ->make(true);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('dashboard.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $slug = Str::slug($request->name);
        $count = Product::where('slug', 'LIKE', "{$slug}%")->count();
        $slug = $count ? "{$slug}-{$count}" : $slug;


        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'stock' => $request->stock,
            'status' => $request->status ?? 0,
            'slug' => $slug,
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {

                $path = $image->store('products', 'public');

                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $path,
                ]);
            }
        }


        return redirect()->route('admin.products.index')
            ->with('success', 'Product added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('dashboard.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $slug = Str::slug($request->name);
        $count = Product::where('slug', 'LIKE', "{$slug}%")
            ->where('id', '!=', $product->id)
            ->count();

        $slug = $count ? "{$slug}-{$count}" : $slug;

        // 🔹 Update product data ONLY
        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'stock' => $request->stock,
            'status' => $request->status ?? 0,
            'slug' => $slug,
        ]);

        // 🔹 Add new images if uploaded
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {

                $path = $image->store('products', 'public');

                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $path,
                ]);
            }
        }

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product updated successfully');
    }
  

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product deleted successfully');
    }
}
