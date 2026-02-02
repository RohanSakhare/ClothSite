<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;

// admin routes
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;


Route::get('/', [HomeController::class, 'index'])->name('home');

// product route

Route::get('/products', [ProductController::class, 'index'])->name('home');
Route::get('/category/{category:slug}', [ProductController::class, 'category'])->name('category.products');
Route::get('/product/{product:slug}', [ProductController::class, 'show'])->name('product.show');


// cart route
Route::get('/cart', [CartController::class, 'cart'])->name('cart.index');
Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{product}', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard.index');
    })->name('dashboard');

    // products 
    Route::get('products/data', [AdminProductController::class, 'data'])->name('products.data');
    Route::resource('products', AdminProductController::class);

    // categories
    Route::get('categories/data', [AdminCategoryController::class, 'data'])->name('categories.data');
    Route::resource('categories', AdminCategoryController::class)->except(['create', 'edit', 'show']);
    
});

require __DIR__ . '/auth.php';
