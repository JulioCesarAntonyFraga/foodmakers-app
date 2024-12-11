<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('index');
});
Route::get('/product-list', function () {
    $products = Product::all();
    return view('product-list', ['products' => $products]);
});
Route::get('/create-product', function () {
    return view('create-product');
});
Route::post('/create', [UserController::class, 'create']);

Route::post('/create-product', [ProductController::class, 'create']);

Route::post('/login', [UserController::class, 'login']);

Route::get('/register', function () {
    return view('register');
});

Route::get('/logout', [UserController::class, 'logout']);

Route::get('edit-product/{product}', [ProductController::class, 'editView']);

Route::put('edit-product/{product}', [ProductController::class, 'edit']);

Route::post('/upload-image', [ProductController::class, 'addImage']);

Route::delete('/delete-image', [ProductController::class, 'deleteImage']);

Route::delete('remove-product/{product}', [ProductController::class, 'remove']);
