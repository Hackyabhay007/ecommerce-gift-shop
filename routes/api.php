<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HeroSectionController;

// Public routes for authentication
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::get('hero-sections', [HeroSectionController::class, 'index']);
Route::get('hero-sections/{id}', [HeroSectionController::class, 'show']);
Route::resource('products', ProductController::class);
Route::get('/products/category/{category}', [ProductController::class, 'getProductsByCategory']); // Get products by category
Route::get('/products/{id}', [ProductController::class, 'getProductById']); // Get product by ID
Route::get('blogs', [BlogController::class, 'index']);  // Paginated blogs
Route::get('blogs/{blog}', [BlogController::class, 'show']);  // Show single blog
// Protected routes (requires token)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);


    // Orders
   // Get all orders
   Route::get('orders', [OrderController::class, 'index']); 
    Route::post('orders', [OrderController::class, 'store']); // Create an order
    Route::get('orders/{id}', [OrderController::class, 'show']); // Show a specific order
    // Blogs
    Route::resource('blogs', BlogController::class);

    // Hero Section
    Route::resource('hero-sections', HeroSectionController::class);


});
