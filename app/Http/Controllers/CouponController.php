<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    // Get all coupons
    public function index()
    {
        return Coupon::all();
    }

    // Store a new coupon
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|unique:coupons',
            'discount' => 'required|numeric',
            'expiry_date' => 'required|date',
        ]);

        $coupon = Coupon::create($validated);
        return response()->json($coupon, 201);
    }

    // Show a coupon by ID
    public function show(Coupon $coupon)
    {
        return response()->json($coupon);
    }

    // Update a coupon
    public function update(Request $request, Coupon $coupon)
    {
        $coupon->update($request->all());
        return response()->json($coupon);
    }

    // Delete a coupon
    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return response()->json(null, 204);
    }
}
