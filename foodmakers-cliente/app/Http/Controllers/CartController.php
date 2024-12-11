<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cartView(){
        if (!auth()->user()){
            return redirect('/');
        }
        if (!auth()->user()->cart || !auth()->user()->cart->where('ordered', false)->exists()) {
            return view('cart', ['cartProducts' => [], 'products' => [], 'images' => [], 'cart' => auth()->user()->cart()->create()]);
        }

        $cart = auth()->user()->cart->where('ordered', false)->first();

        $cartProducts = $cart->products;
        $products = Product::all();
        $images = ProductImage::all();

        return view('cart', ['cartProducts' => $cartProducts, 'products' => $products, 'images' => $images, 'cart' => $cart]);
    }

    public function updateCartTotalPrice(Cart $cart, Product $addProduct, bool $isAddition){
        $cartProducts = $cart->products;

        $totalValue = 0;

        if ($addProduct){
            if ($isAddition){
                $totalValue += $addProduct->price;
            }
        }

        if ($cartProducts->isNotEmpty()){
            foreach ($cartProducts as $cartProduct){
                $product = Product::where('id', $cartProduct->product_id)->first();
                $totalValue += $product->price * $cartProduct->quantity;
            }
        }

        $cart['total_price'] = $totalValue;
    }

    public function addToCart(String $product_id){
        if (!auth()->user()->cart || !auth()->user()->cart->where('ordered', false)->exists()){
            $cart = auth()->user()->cart()->create();
        }
        else{
            $cart = auth()->user()->cart->where('ordered', false)->first();
        }

        if ($cart->products->isNotEmpty() && $cart->products()->where('product_id', $product_id)->exists()){
            $cartProduct = $cart->products()->where('product_id', $product_id)->first();
            $cartProduct->update([
                'quantity' => $cartProduct->quantity + 1
            ]);
            $this->updateCartTotalPrice($cart, Product::where('id', $product_id)->first(), true);
            $cart->update();

            return redirect('/cart');
        }

        $cart->products()->create([
            'quantity' => 1,
            'product_id' => $product_id
        ]);

        $this->updateCartTotalPrice($cart, Product::where('id', $product_id)->first(), true);
        $cart->update();

        return redirect('/cart');
    }

    public function removeFromCart(String $product_id){
        $cart = auth()->user()->cart->where('ordered', false)->first();

        if ($cart->products()->where('product_id', $product_id)->exists()){
            $cartProduct = $cart->products()->where('product_id', $product_id)->first();

            if ($cartProduct->quantity <= 1){
                $cartProduct->delete();
                $this->updateCartTotalPrice($cart, Product::where('id', $product_id)->first(), false);
                $cart->update();

                return redirect('/cart');
            }

            $cartProduct->update([
                'quantity' => $cartProduct->quantity - 1
            ]);
            $this->updateCartTotalPrice($cart, Product::where('id', $product_id)->first(), false);
            $cart->update();
            return redirect('/cart');
        }

        return redirect('/cart');
    }

    public function createOrder(Request $request, Cart $cart){
        if ($cart->products->isEmpty()){
            return redirect('/cart');
        }
        $cart['ordered'] = true;

        $incomingFields = $request->validate([
            'address' => 'required',
            'cupon' => '',
            'payment_method' => 'required',
            'phone' => 'required',
            'observations' => ''
        ]);

        $cart['address'] = $incomingFields['address'];
        $cart['cupon'] = $incomingFields['cupon'];
        $cart['payment_method'] = $incomingFields['payment_method'];
        $cart['phone'] = $incomingFields['phone'];
        $cart['observations'] = $incomingFields['observations'];

        $cart->update();

        auth()->user()->cart()->create();

        return redirect('/product-list');
    }
}
