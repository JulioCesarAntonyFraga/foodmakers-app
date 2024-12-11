<?php

use App\Models\Product;
use App\Models\Category;
use App\Models\CartProduct;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('index');
});

Route::get('/product-list', function () {
    $images = ProductImage::all();
    $categories = Category::all();

    // Filtrando por query string "id"
    $category_id = request()->query('id');

    if ($category_id) {
        $products = Product::where('category_id', $category_id)->get();
    } else {
        $products = Product::all();
    }

    return view('product-list', [
        'products' => $products,
        'images' => $images,
        'categories' => $categories,
        'category_id' => $category_id
    ]);
});

Route::get('/cart', [CartController::class, 'cartView']);

Route::post('/add/{product_id}', [CartController::class, 'addToCart']);

Route::delete('/delete/{product_id}', [CartController::class, 'removeFromCart']);

Route::post('/create-order/{cart}', [CartController::class, 'createOrder']);

Route::get('/product-details/{product}', [ProductController::class, 'productDetailsView']);

Route::post('/login', [UserController::class, 'login']);

Route::get('/register', function () {
    return view('register');
});

Route::get('/logout', [UserController::class, 'logout']);
