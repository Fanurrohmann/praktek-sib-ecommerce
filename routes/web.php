<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\CekOngkirController;
use App\Http\Controllers\Dashboard\CheckoutController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Redirect root to the dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

// Grouped routes for dashboard features, accessible only with authentication
Route::prefix('dashboard')->middleware(['auth'])->name('dashboard.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    Route::resource('cek-ongkir', CekOngkirController::class)->names('cek-ongkir');
    Route::resource('checkout', CheckoutController::class)->names('checkout');
    Route::resource('products', ProductController::class)->only(['index', 'store', 'destroy'])->names('products');
    Route::redirect('/test', '/dashboard/products');
});

// Profile routes
Route::resource('dashboard/profile', ProfileController::class)->only(['index', 'update'])->names('dashboard.profile');

// Authentication routes
Auth::routes();

// Optional home route for backward compatibility if needed
Route::get('/home', [DashboardController::class, 'index'])->name('home');
