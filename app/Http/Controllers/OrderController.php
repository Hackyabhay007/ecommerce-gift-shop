<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function index()
    {
        // Show all orders for the logged-in user
        $orders = Order::where('email', auth()->user()->email)->get();
        return response()->json($orders);
    }

    public function store(Request $request)
    {
        // Validate request
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'email' => 'required|email',
            'address' => 'required|string|max:255',
            'state' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'pincode' => 'required|string|max:6',
            'country' => 'required|string|max:100',
            'phone_number' => 'required|string|max:15',
            'price' => 'required|numeric',
            'payment_type' => 'required|in:cod,online',
            'coupon_used' => 'nullable|string|max:50',
        ]);

        // Create new order
        $order = Order::create([
            'order_id' => Str::random(10), // Generate random 10 digit alphanumeric order ID
            'product_id' => $request->product_id,
            'email' => $request->email,
            'address' => $request->address,
            'state' => $request->state,
            'city' => $request->city,
            'pincode' => $request->pincode,
            'country' => $request->country,
            'phone_number' => $request->phone_number,
            'price' => $request->price,
            'payment_type' => $request->payment_type,
            'coupon_used' => $request->coupon_used,
        ]);

        return response()->json([
            'message' => 'Order created successfully',
            'order' => $order
        ], 201);
    }
    
    public function show($id)
    {
        $order = Order::findOrFail($id);
        return response()->json($order);
    }
}
