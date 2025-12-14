<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // 🔹 Get all products
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
            'message' => 'Products retrieved successfully.',
            'data' => $products
        ], 200);
    }

    // 🔹 Get single product by ID
    public function show($id){
        $product = Product::find($id);

        if(!$product){
            return response()->json([
                'status' => 'error',
                'message' => 'Product not found.'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Product retrieved successfully.',
            'data' => $product,
        ]);
    }
    
    // 🔹 Create product
    public function store(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image_url' => 'nullable|string',
            'status' => 'nullable|string'
        ]);

        $product = Product::create([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'price' => $validatedData['price'],
            'stock' => $validatedData['stock'],
            'image_url' => $validatedData['image_url'] ?? null,
            'status' => $validatedData['status'] ?? 'active',
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Product created successfully.',
            'data' => $product
        ], 201);
    }

    // 🔹 Update product
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
            'stock' => 'sometimes|required|integer|min:0',
            'image_url' => 'nullable|string',
            'status' => 'nullable|string'
        ]);

        $product->update($validatedData);

        return response()->json([
            'status' => 'success',
            'message' => 'Product updated successfully.',
            'data' => $product
        ], 200);
    }

    // 🔹 Delete product
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

    // 🔹 Toggle product status (active/inactive)
    public function toggleProductStatus($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'status' => 'error',
                'message' => 'Product not found.'
            ], 404);
        }

        // toggle between active/inactive
        if (isset($product->status)) {
            $product->status = $product->status === 'active' ? 'inactive' : 'active';
            $product->save();
        } else {
            $product->status = 'active';
            $product->save();
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Product status toggled successfully.',
            'data' => [
                'id' => $product->id,
                'new_status' => $product->status
            ]
        ]);
    }
}
