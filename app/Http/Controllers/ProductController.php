<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequestStore;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return response()->json([
            'success' => true,
            'data' => $products,
            'message' => 'all products'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequestStore $request)
    {
        $product = Product::create([
            'name' => $request->name,
            'slug' => str()->slug($request->name),
            'price' => $request->price
        ]);

        // $file =$request->file('image');
        // $extension = $file->getClientOriginalExtension(); 
        // $filename = time().'.' . $extension;
        // $file->move(public_path('uploads/'), $filename);
        // $imagePath = 'public/uploads/'.$filename;

        // $product->image = $imagePath;

        $product->save();

        return request()->json([
            'success' => true,
            'message' => 'new product created'
        ]);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::where('id', $id)->first();
        return request()->json([
            'success' => true,
            'data' => $product,
            'message' => 'new product created'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::where('id', $id)->first();
        if($product) {
            $product->name = $request->name;
            $product->price = $request->price;
            $product->slug = str()->slug($request->name);
            $product->save();
            return request()->json([
                'success' => true,
                'data' => $product,
                'message' => 'product updated'
            ]);

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::where('id', $id)->delete();
        return request()->json([
            'success' => true,
            'message' => 'product deleted'
        ]);
    }
}
