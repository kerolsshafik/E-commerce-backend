<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    //     public function checkout(Request $request)
    // {
    //     $user = Auth::user();
    //     $cartItems = $request->input('cart_items'); // Assuming you have cart items sent in the request

    //     $order = $user->orders()->create(['status' => 'pending']); // Create an order

    //     foreach ($cartItems as $cartItem) {
    //         $product = Product::find($cartItem['product_id']);
    //         $order->products()->attach($product, ['quantity' => $cartItem['quantity']]);
    //     }

    //     // Clear the user's cart or perform any necessary operations

    //     return response()->json(['message' => 'Order placed successfully']);
    // }

// public function payment(Request $request){
//     Stripe::setApiKey(env('STRIPE_KEY'));
//     try {
//         $checkout_session = Session::create([
//             'payment_method_types' => ['card'],
//             'line_items' => [
//                 [
//                     'price_data' => [
//                         'currency' => 'usd',
//                         'unit_amount' => $this->$request->cartitems ,
//                         'product_data' => [
//                             'name' => 'Stubborn Attachments',                         ],
//                     ],
//                     'quantity' => 1,
//                 ],
//             ],
//             'mode' => 'payment',
//             'success_url' => route('success'),
//             'cancel_url' => route('cancel'),
            
//         ]);
//     } catch (\Throwable $th) {
//         return response()->json(['message' => 'Error creating checkout session']);
//     }
    


// }



}
