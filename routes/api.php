<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HeroSectionController;

// Public routes for authentication
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

// Public routes for hero sections
Route::get('hero-sections', [HeroSectionController::class, 'index']);
Route::get('hero-sections/{id}', [HeroSectionController::class, 'show']);

// Public routes for products
Route::get('/products/category/{category}', [ProductController::class, 'getProductsByCategory']); // Get products by category
Route::get('/products/{id}', [ProductController::class, 'getProductById']); // Get product by ID
Route::resource('products', ProductController::class)->only(['index', 'show']); // Only listing and showing products

// Public blog routes
Route::get('blogs', [BlogController::class, 'index']);  // Paginated blogs
Route::get('blogs/{blog}', [BlogController::class, 'show']);  // Show single blog

// Get blogs with custom URL pattern (pagination)
Route::get('/blog/blogs-{start}-{end}', [BlogController::class, 'index']);

// Protected routes (requires token)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);

    // Orders (only for authenticated users)
    // Create a new order
Route::post('/orders', [OrderController::class, 'store'])->middleware('auth:sanctum');

// Get paginated list of all orders (Admin use or general use)
Route::get('/orders', [OrderController::class, 'index'])->middleware('auth:sanctum');

// Get a specific order by order ID
Route::get('/orders/{order_id}', [OrderController::class, 'show'])->middleware('auth:sanctum');

// Get all orders of the authenticated user
Route::get('/user/orders', [OrderController::class, 'userOrders'])->middleware('auth:sanctum');

    // Protected hero section routes
    Route::resource('hero-sections', HeroSectionController::class)->except(['index', 'show']);
});
