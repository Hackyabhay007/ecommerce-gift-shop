<?php
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\CouponController;
Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

// Authentication routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');



// Protect admin routes with 'auth' middleware
Route::middleware(['auth'])->prefix('admin')->group(function () {
    // Admin dashboard
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');
    // Product routes (manually defined)
    Route::get('products', [AdminProductController::class, 'index'])->name('admin.products.index'); // List all products
    Route::get('products/create', [AdminProductController::class, 'create'])->name('admin.products.create'); // Show form to create a product
    Route::post('products', [AdminProductController::class, 'store'])->name('admin.products.store'); // Store new product
    Route::get('products/{product}', [AdminProductController::class, 'show'])->name('admin.products.show'); // Show a single product
    Route::get('products/{product}/edit', [AdminProductController::class, 'edit'])->name('admin.products.edit'); // Show form to edit product
    Route::put('products/{product}', [AdminProductController::class, 'update'])->name('admin.products.update'); // Update a product
    Route::delete('products/{product}', [AdminProductController::class, 'destroy'])->name('admin.products.destroy'); // Delete a product
    Route::resource('coupons', CouponController::class); // Add this line for coupons

     // Coupon routes
     Route::get('/coupons', [CouponController::class, 'index'])->name('admin.coupons.index');
     Route::get('/coupons/create', [CouponController::class, 'create'])->name('admin.coupons.create');
     Route::post('/coupons', [CouponController::class, 'store'])->name('admin.coupons.store');
     Route::get('/coupons/{coupon}/edit', [CouponController::class, 'edit'])->name('admin.coupons.edit');
     Route::put('/coupons/{coupon}', [CouponController::class, 'update'])->name('admin.coupons.update');
     Route::delete('/coupons/{coupon}', [CouponController::class, 'destroy'])->name('admin.coupons.destroy');
 
});

