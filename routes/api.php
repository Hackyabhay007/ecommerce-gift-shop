<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HeroSectionController;
use App\Http\Controllers\CouponController;

// Public routes for authentication
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

// Protected routes (requires token)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);

    // Products
    Route::resource('products', ProductController::class);
    
    // Orders
    Route::resource('orders', OrderController::class);
    
    // Blogs
    Route::resource('blogs', BlogController::class);
    
    // Hero Section
    Route::resource('hero-sections', HeroSectionController::class);
    
    // Coupons
    Route::resource('coupons', CouponController::class);
});
