<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Exception;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $products = Product::paginate(10);
            return response()->json($products, 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to retrieve products'], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);
    
        try {
            $product = Product::create($validatedData);
            return response()->json($product,201);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to create product'], 500);
        }
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $product = Product::findOrFail($id);
            return response()->json($product, 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Product not found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);
    
        try {
            $product = Product::findOrFail($id);
            $product->update($validatedData);
            return response()->json($product, 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to update product'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $product = Product::findOrFail($id);
            $product->delete();
            return response()->json(null, 204);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to delete product'], 500);
        }
    }
}
