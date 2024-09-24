<?php



use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminProductController;

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
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('products', AdminProductController::class);
    Route::get('admin/products/{product}/edit', [AdminProductController::class, 'edit'])->name('admin.products.edit');

});
