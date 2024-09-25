<?php
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\AdminHeroSectionController;
use App\Http\Controllers\Admin\AdminCategoryController;
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
    Route::get('/admin/products/images', [AdminProductController::class, 'getUploadedImages'])->name('admin.products.images');
    Route::get('/products/images', [ProductController::class, 'getUploadedImages'])->name('admin.products.images');
    Route::post('/products/upload', [ProductController::class, 'uploadImage'])->name('admin.products.upload');
    
    // Hero Section routes
    Route::get('/hero-sections', [AdminHeroSectionController::class, 'index'])->name('admin.hero-sections.index');
    Route::get('/hero-sections/create', [AdminHeroSectionController::class, 'create'])->name('admin.hero-sections.create');
    Route::post('/hero-sections', [AdminHeroSectionController::class, 'store'])->name('admin.hero-sections.store');
    Route::get('/hero-sections/{heroSection}/edit', [AdminHeroSectionController::class, 'edit'])->name('admin.hero-sections.edit');
    Route::put('/hero-sections/{heroSection}', [AdminHeroSectionController::class, 'update'])->name('admin.hero-sections.update');
    Route::delete('/hero-sections/{heroSection}', [AdminHeroSectionController::class, 'destroy'])->name('admin.hero-sections.destroy');
     // Coupon routes
     Route::get('/coupons', [CouponController::class, 'index'])->name('admin.coupons.index');
     Route::get('/coupons/create', [CouponController::class, 'create'])->name('admin.coupons.create');
     Route::post('/coupons', [CouponController::class, 'store'])->name('admin.coupons.store');
     Route::get('/coupons/{coupon}/edit', [CouponController::class, 'edit'])->name('admin.coupons.edit');
     Route::put('/coupons/{coupon}', [CouponController::class, 'update'])->name('admin.coupons.update');
     Route::delete('/coupons/{coupon}', [CouponController::class, 'destroy'])->name('admin.coupons.destroy');

        // Category routes
        Route::get('/categories', [AdminCategoryController::class, 'index'])->name('admin.categories.index');
        Route::get('/categories/create', [AdminCategoryController::class, 'create'])->name('admin.categories.create');
        Route::post('/categories', [AdminCategoryController::class, 'store'])->name('admin.categories.store');
        Route::get('/categories/{category}/edit', [AdminCategoryController::class, 'edit'])->name('admin.categories.edit');
        Route::put('/categories/{category}', [AdminCategoryController::class, 'update'])->name('admin.categories.update');
        Route::delete('/categories/{category}', [AdminCategoryController::class, 'destroy'])->name('admin.categories.destroy');

});

