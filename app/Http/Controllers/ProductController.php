<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    //
    public function index() {
        $products = Product::all();

        if($products->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'No Products found.'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Product retireved',
            'data' => $products
        ], 200);
    }

    public function show($id){
        $product = Product::where('id', $id)->first();

        if(!$product){
            return response()->json([
                'status' => 'error',
                'message' => 'product is not found'
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Product Retrieved Sucessfully',
            'data' => $product,
        ]);
    }
    
    public function store(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|decimal:2',
            'image_url' => 'nullable',
            'stock' => 'required|integer', 
        ]);

        if($validatedData){
            $product = Product::create([
                'name' =>           $validatedData['name'],
                'description' =>     $validatedData['description'],
                'price' =>          $validatedData['price'],
                'image_url' =>       $validatedData['image_url'],
                'stock' =>          $validatedData['stock'],
            ]);

            if(!$product){
                return response()->json([
                    'status' => 'error',
                    'message' => "An error occured when creating a product.",
                ]);
            }

            return response()->json([
                'status' => 'success',
                'message' => "Product created succesfully.",
                'data' => $product
            ]);
            
        }
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'status' => 'error',
                'message' => 'Product not found.'
            ], 404);
        }

        $validatedData = $request->validate([
            'name' => 'sometimes|required|string',
            'description' => 'sometimes|required|string',
            'price' => 'sometimes|required|numeric|min:0',
            'image_url' => 'nullable|string',
            'stock' => 'sometimes|required|integer|min:0',
        ]);

        $product->update($validatedData);

        return response()->json([
            'status' => 'success',
            'message' => 'Product updated successfully.',
            'data' => $product
        ], 200);
    }

    // 🔴 Delete product
    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'status' => 'error',
                'message' => 'Product not found.'
            ], 404);
        }

        $product->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Product deleted successfully.'
        ], 200);
    }

    // 🟣 Toggle product status (example: active/inactive)
    public function toggleProductStatus($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'status' => 'error',
                'message' => 'Product not found.'
            ], 404);
        }

        $product->status = !$product->status;
        $product->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Product status toggled successfully.',
            'data' => [
                'id' => $product->id,
                'new_status' => $product->status ? 'active' : 'inactive'
            ]
        ]);
    }

}
