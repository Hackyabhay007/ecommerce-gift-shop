<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        // Example logic for the admin dashboard
        $productCount = \App\Models\Product::count();
        $totalStock = \App\Models\Product::sum('stock_quantity');
        $latestProducts = \App\Models\Product::latest()->take(5)->get();

        return view('admin.dashboard', compact('productCount', 'totalStock', 'latestProducts'));
    }
}
