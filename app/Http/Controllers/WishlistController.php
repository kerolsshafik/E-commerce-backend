<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Models\Cart;
use Illuminate\Http\Request;
use Exception;


class WishlistController extends Controller
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
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        try {
            $wishlist = auth()->user()->wishlist()->create([
                'product_id' => $request->product_id
            ]);
            return response()->json($wishlist, 201);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to add product to wishlist'], 500);
        }
    }


       public function destroy($id)
    {
        try {
            auth()->user()->wishlist()->where('product_id', $id)->delete();
            return response()->json(null, 204);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to remove product from wishlist'], 500);
        }
    }


}
