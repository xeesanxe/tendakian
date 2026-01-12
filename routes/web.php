<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderAdminController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\UserRegistrationController;

// Public pages
Route::get('/', function () { return view('home'); });
Route::get('/about', function () { return view('about'); });
Route::get('/services', function () { return view('services'); });

// User auth
Route::get('/login', [UserAuthController::class, 'showLogin'])->name('login');
Route::post('/login', [UserAuthController::class, 'login'])->name('login.post');
Route::get('/register', [UserRegistrationController::class, 'showRegister'])->name('register');
Route::post('/register', [UserRegistrationController::class, 'register'])->name('register.post');
Route::post('/logout', [UserAuthController::class, 'logout'])->name('logout');

// User dashboard (protected) - redirect to profile
Route::get('/dashboard', function() {
    return redirect()->route('profile');
})->middleware('auth')->name('dashboard');

// Shop / product
Route::get('/shop', [ProductController::class, 'index']);
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');

// Cart
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart/add', [CartController::class, 'addFromGet'])->name('cart.add.get');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

// Checkout
Route::get('/checkout', function(){ return view('checkout'); });
Route::post('/checkout', [OrderController::class, 'store'])->name('checkout.store');

// Thank you page
Route::get('/thankyou', function(){ return view('thankyou'); });

// Profile (shows session cart + user orders)
Route::get('/profile', [UserProfileController::class, 'index'])
    ->middleware('auth')
    ->name('profile');

// Payment
Route::get('/payment/instructions/{id}', [PaymentController::class, 'instructions'])->name('payment.instructions');
Route::post('/payment/mock/{id}', [PaymentController::class, 'mockPay'])->name('payment.mock');

// Admin auth
Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// Admin routes (protected using middleware class directly)
Route::middleware(\App\Http\Middleware\EnsureAdmin::class)->group(function(){
    Route::get('/admin', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index']);
    
    // Order management routes
    Route::get('/admin/orders', [OrderAdminController::class, 'index'])->name('admin.orders.index');
    Route::get('/admin/orders/{id}', [OrderAdminController::class, 'show'])->name('admin.orders.show');
    Route::post('/admin/orders/{id}/mark-paid', [OrderAdminController::class, 'markPaid'])->name('admin.orders.markPaid');
    Route::post('/admin/orders/{id}/cancel', [OrderAdminController::class, 'cancel'])->name('admin.orders.cancel');
    Route::post('/admin/orders/bulk-delete', [OrderAdminController::class, 'bulkDelete'])->name('admin.orders.bulkDelete');
    Route::post('/admin/orders/bulk-update-status', [OrderAdminController::class, 'bulkUpdateStatus'])->name('admin.orders.bulkUpdateStatus');
    
    // Product management routes
    Route::get('/admin/products', [AdminProductController::class, 'index'])->name('admin.products.index');
    Route::get('/admin/products/create', [AdminProductController::class, 'create'])->name('admin.products.create');
    Route::post('/admin/products', [AdminProductController::class, 'store'])->name('admin.products.store');
    Route::get('/admin/products/{id}/edit', [AdminProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/admin/products/{id}', [AdminProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/admin/products/{id}', [AdminProductController::class, 'destroy'])->name('admin.products.destroy');
    Route::post('/admin/products/{id}/toggle-status', [AdminProductController::class, 'toggleStatus'])->name('admin.products.toggleStatus');
    
    // Enhanced delete features
    Route::delete('/admin/products/{id}/soft-delete', [AdminProductController::class, 'softDelete'])->name('admin.products.softDelete');
    Route::post('/admin/products/{id}/restore', [AdminProductController::class, 'restore'])->name('admin.products.restore');
    Route::get('/admin/products/trashed', [AdminProductController::class, 'trashed'])->name('admin.products.trashed');
    Route::post('/admin/products/bulk-delete', [AdminProductController::class, 'bulkDelete'])->name('admin.products.bulkDelete');
});

