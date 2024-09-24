<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HeroSectionController;

// Public routes for authentication
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

// Protected routes (requires token)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);

    // Products
    Route::resource('products', ProductController::class);

    // Orders
    Route::get('/orders', [OrderController::class, 'index']);  // Get all orders for the logged-in user
    Route::post('/orders', [OrderController::class, 'store']); // Create a new order
    Route::get('/orders/{id}', [OrderController::class, 'show']); // Get details of a specific order

    // Blogs
    Route::resource('blogs', BlogController::class);

    // Hero Section
    Route::resource('hero-sections', HeroSectionController::class);


});
