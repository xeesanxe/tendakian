<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/shop', function () {
    return view('shop');
});

Route::get('/services', function () {
    return view('services');
});

Route::get('/blog', function () {
    return view('blog');
});

Route::get('/contact', function () {
    return view('contact');
});

use App\Http\Controllers\CartController;

Route::get('/cart', [CartController::class, 'index']);

Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart/add', [CartController::class, 'addFromGet'])->name('cart.add.get');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');