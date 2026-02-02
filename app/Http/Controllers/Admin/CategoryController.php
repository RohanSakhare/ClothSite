<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.categories.category');
    }


    public function data()
    {
        $Category = Category::query();

        return DataTables::of($Category)
            ->addIndexColumn()

            ->addColumn('status', function ($product) {
                return $product->status
                    ? '<span class="badge bg-success">Active</span>'
                    : '<span class="badge bg-danger">Inactive</span>';
            })

            ->addColumn('action', function ($row) {
                return '
        <div class="d-flex gap-2">
             <button 
                        class="btn btn-sm btn-warning edit-category"
                        data-id="'.$row->id.'"
                        data-name="'.$row->name.'"
                        data-status="'.$row->status.'">
                        Edit
                    </button>

             <form action="' . route('admin.categories.destroy', $row->id) . '"
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


            ->rawColumns(['status', 'action'])
            ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'   => 'required|string|max:255|unique:categories,name',
            'status' => 'required|boolean',
        ]);

        Category::create([
            'name'   => $request->name,
            'slug'   => Str::slug($request->name),
            'status' => $request->status,
        ]);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category added successfully');
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
    public function edit(string $id)
    {
        //
         return redirect()->route('admin.categories.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name'   => 'required|string|max:255|unique:categories,name,' . $category->id,
            'status' => 'required|boolean',
        ]);

        $category->update([
            'name'   => $request->name,
            'slug'   => Str::slug($request->name),
            'status' => $request->status,
        ]);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if ($category->products()->count() > 0) {
            return redirect()
                ->route('admin.categories.index')
                ->with('success', 'Category has products. Cannot delete.');
        }

        $category->delete();

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category deleted successfully');
    }
}
