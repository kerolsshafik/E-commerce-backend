<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Validator;

use Exception;
class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $cartItems = auth()->user()->cart()->with('product')->get();
            return response()->json($cartItems, 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to retrieve cart items'], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        try {
            $cart = auth()->user()->cart()->updateOrCreate(
                ['product_id' => $request->product_id],
                ['quantity' => $request->quantity]
            );
            return response()->json($cart, 201);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to add product to cart'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            auth()->user()->cart()->where('product_id', $id)->delete();
            return response()->json(null, 204);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to remove product from cart'], 500);
        }
    }
}
