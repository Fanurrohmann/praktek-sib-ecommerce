<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\RajaOngkirController;
use App\Http\Controllers\Api\MidtransController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// API Categories
Route::resource('categories', CategoryController::class);
// API Products
Route::resource('products', ProductController::class);

Route::post('midtrans/callback', [MidtransController::class, 'callback']);

Route::get('provinces', [RajaOngkirController::class, 'provinces']);
Route::get('cities/{provinceId}', [RajaOngkirController::class, 'cities']);
Route::post('cost', [RajaOngkirController::class, 'cekOngkir']);