<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Exception;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function show()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $cartItems = auth()->user()->cart()->with('product')->get();
            $item_name=$cartItems->product->name;
            $item_quantity=$cartItems->quantity;
            $item_peice=$cartItems->product->price;
            $total = $cartItems->sum(function ($item) {
                return $item->product->price * $item->quantity;
            });

            $order = auth()->user()->orders()->create([
                'total' => $total,
                'status' => 'pending'
            ]);

            foreach ($cartItems as $item) {
                $order->products()->attach($item->product_id, ['quantity' => $item->quantity]);
            }

            auth()->user()->cart()->delete();

            return response()->json($order, 201);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to complete checkout'], 500);
        }
    }}
