<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function addImage(Request $request){
        $incomingFields =  $request->validate([
            'content' => 'required|mimes:jpg,png,pdf|max:2048',
            'product_id' => 'required',
        ]);

        $type = $incomingFields['content']->getClientOriginalExtension();
        $image = base64_encode(file_get_contents($request->file('content')->path()));

        $base64 = 'data:image/' . $type . ';base64,' . $image;
        $incomingFields['content'] = $base64;

        ProductImage::create($incomingFields);

        return redirect('edit-product/'.$incomingFields['product_id']);
    }

    public function deleteImage(Request $request){
        $incomingFields =  $request->validate([
            'id' => 'required',
            'product_id' => 'required',
        ]);

        $image = ProductImage::find($incomingFields['id']);
        $image->delete();

        return redirect('edit-product/'.$incomingFields['product_id']);
    }

    public function editView(Product $product)
    {
        if (auth()){
            $images = ProductImage::where('product_id', $product->id)->get();
            return view('edit-product', ['product' => $product, 'images' => $images]);
        }
        return redirect('/');
    }

    public function edit(Product $product, Request $request)
    {
        if (auth()){
            $incomingFields = $request->validate([
                'name' => ['required', 'string'],
                'description' => [],
                'price' => ['required', 'decimal:0,2'],
                'category_id' => ['required', 'integer'],
            ]);

            $product->update($incomingFields);

            return redirect('/product-list');
        }
        return redirect('/');
    }

    public function create(Request $request)
    {
        if (auth()){
            $incomingFields = $request->validate([
                'name' => ['required', 'string'],
                'description' => [],
                'price' => ['required', 'decimal:0,2'],
                'category_id' => ['required', 'integer'],
            ]);

            $incomingFields['description'] = strip_tags($incomingFields['description']);

            $product = Product::create($incomingFields);

            return view('edit-product', ['product' => $product, 'images' => []]);
        }
        return redirect('/');
    }

    public function remove(Product $product)
    {
        if (auth()){
            $images = ProductImage::where('product_id', $product->id)->get();
            foreach ($images as $image){
                $image->delete();
            }
            $product->delete();
            return redirect('/product-list');
        }
        return redirect('/');
    }
}
