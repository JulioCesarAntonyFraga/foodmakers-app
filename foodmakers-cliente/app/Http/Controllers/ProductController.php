<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function addToCart(String $product_id){
        if (!auth()->user()->cart){
            auth()->user()->cart()->create();
        }

        $cart = auth()->user()->cart;

        if ($cart->products->isNotEmpty() && $cart->products()->where('product_id', $product_id)->exists()){
            $cartProduct = $cart->products()->where('product_id', $product_id)->first();
            $cartProduct->update([
                'quantity' => $cartProduct->quantity + 1
            ]);
            return redirect('/cart');
        }

        $cart->products()->create([
            'quantity' => 1,
            'product_id' => $product_id
        ]);

        return redirect('/cart');
    }

    public function productDetailsView(Product $product){
        $images = ProductImage::where('product_id', $product->id)->get();
        return view('product-details', ['product' => $product, 'images' => $images]);
    }
}
