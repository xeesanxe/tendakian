<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderAdminController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\UserProfileController;

// Public pages
Route::get('/', function () { return view('home'); });
Route::get('/about', function () { return view('about'); });
Route::get('/services', function () { return view('services'); });
Route::get('/blog', function () { return view('blog'); });
Route::get('/contact', function () { return view('contact'); });

// Shop / product
Route::get('/shop', [ProductController::class, 'index']);
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');

// Cart
Route::get('/cart', [CartController::class, 'index']);
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart/add', [CartController::class, 'addFromGet'])->name('cart.add.get');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');

// Checkout
Route::get('/checkout', function(){ return view('checkout'); });
Route::post('/checkout', [OrderController::class, 'store'])->name('checkout.store');

// Thank you page
Route::get('/thankyou', function(){ return view('thankyou'); });

// Profile (shows session cart + user orders)
Route::get('/profile', [UserProfileController::class, 'index'])->name('profile');

// Payment
Route::get('/payment/instructions/{id}', [PaymentController::class, 'instructions'])->name('payment.instructions');
Route::post('/payment/mock/{id}', [PaymentController::class, 'mockPay'])->name('payment.mock');

// Admin auth
Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// Admin routes (protected using middleware class directly)
Route::middleware(\App\Http\Middleware\EnsureAdmin::class)->group(function(){
    Route::get('/admin', function(){ return redirect('/admin/orders'); });
    Route::get('/admin/orders', [OrderAdminController::class, 'index']);
    Route::get('/admin/orders/{id}', [OrderAdminController::class, 'show']);
    Route::post('/admin/orders/{id}/mark-paid', [OrderAdminController::class, 'markPaid'])->name('admin.orders.markPaid');
    Route::post('/admin/orders/{id}/cancel', [OrderAdminController::class, 'cancel'])->name('admin.orders.cancel');

    // Admin product management
    Route::get('/admin/products', [AdminProductController::class, 'index'])->name('admin.products.index');
    Route::get('/admin/products/create', [AdminProductController::class, 'create'])->name('admin.products.create');
    Route::post('/admin/products', [AdminProductController::class, 'store'])->name('admin.products.store');
    Route::get('/admin/products/{id}/edit', [AdminProductController::class, 'edit'])->name('admin.products.edit');
    Route::post('/admin/products/{id}', [AdminProductController::class, 'update'])->name('admin.products.update');
    Route::post('/admin/products/{id}/delete', [AdminProductController::class, 'destroy'])->name('admin.products.destroy');
});

