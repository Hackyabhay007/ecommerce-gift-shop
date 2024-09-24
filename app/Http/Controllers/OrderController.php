<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Get all orders
    public function index()
    {
        return Order::all();
    }

    // Store a new order
    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_id' => 'required|unique:orders',
            'user_id' => 'required',
            'product_id' => 'required',
            'quantity' => 'required|integer',
            'status' => 'required|string',
        ]);

        $order = Order::create($validated);
        return response()->json($order, 201);
    }

    // Show an order by ID
    public function show(Order $order)
    {
        return response()->json($order);
    }

    // Update an order
    public function update(Request $request, Order $order)
    {
        $order->update($request->all());
        return response()->json($order);
    }

    // Delete an order
    public function destroy(Order $order)
    {
        $order->delete();
        return response()->json(null, 204);
    }
}
