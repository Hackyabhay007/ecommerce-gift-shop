<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    // Store a new order
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

    // Fetch all orders with pagination
    public function index(Request $request)
    {
        $perPage = $request->query('per_page', 10); // Default to 10 orders per page
        $orders = Order::paginate($perPage);

        return response()->json($orders);
    }

    // Fetch a single order by ID
    public function show($orderId)
    {
        $order = Order::where('order_id', $orderId)->first();

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        return response()->json($order);
    }

    // Fetch orders for the authenticated user
    public function userOrders(Request $request)
    {
        $user = $request->user();
        $orders = Order::where('user_id', $user->id)->get();

        return response()->json($orders);
    }
}
