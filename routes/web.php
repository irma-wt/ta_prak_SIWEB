<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;

// Halaman Utama
Route::get('/', function () {
    return view('index');
})->name('home');

// Halaman Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

// Proses Form Login & Logout
Route::post('/login', [AuthController::class, 'login'])->name('login.proses');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// =============================================
// ROUTE BARU - Week 5
// =============================================

// Halaman Daftar Produk (GET)
Route::get('/products', [ProductController::class, 'index'])->name('products');

// Simpan Produk Baru (POST)
Route::post('/products', [ProductController::class, 'store'])->name('products.store');