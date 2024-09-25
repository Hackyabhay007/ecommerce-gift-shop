<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        try {
            Log::info('Incoming order request:', $request->all());

            $validatedData = $request->validate([
                'product_id' => 'required|integer',
                'email' => 'required|email',
                'address' => 'required|string',
                'state' => 'required|string',
                'city' => 'required|string',
                'pincode' => 'required|string',
                'country' => 'required|string',
                'phone_number' => 'required|string',
                'price' => 'required|numeric',
                'payment_type' => 'required|in:cod,online',
                'coupon_used' => 'nullable|string',
            ]);

            Log::info('Validated data:', $validatedData);

            $order = Order::create([
                'order_id' => strtoupper(uniqid()),
                'user_id' => $request->user()->id,
            ] + $validatedData);

            Log::info('Order created:', $order->toArray());

            return response()->json(['message' => 'Order created successfully', 'order' => $order], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation error: ' . json_encode($e->errors()));
            return response()->json(['error' => 'Validation failed', 'details' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error('Error creating order: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            return response()->json(['error' => 'An error occurred while creating the order', 'details' => $e->getMessage()], 500);
        }
    }
}