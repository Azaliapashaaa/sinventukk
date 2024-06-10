<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\ProductController;

// Default welcome route
Route::get('/', function () {
    return view('welcome');
});

// Resource routes
Route::resource('products',ProductController::class);
Route::resource('shop', ShopController::class);
Route::resource('barang', BarangController::class)->middleware('auth');
Route::resource('kategori', KategoriController::class);
Route::resource('barangmasuk', BarangMasukController::class);
Route::resource('barangkeluar', BarangKeluarController::class);

// Register routes
Route::get('register', [RegisterController::class, 'create']);
Route::post('register', [RegisterController::class, 'store']);

// Login routes
Route::get('login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('login', [LoginController::class, 'authenticate']);

// Logout routes
Route::post('logout', [LoginController::class, 'logout']);
Route::get('logout', [LoginController::class, 'logout']);

