<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

// Halaman utama
Route::get('/', function () {
    return view('welcome');
});

// Autentikasi default (bawaan Laravel Breeze / Jetstream)
require __DIR__.'/auth.php';

// Grup route untuk pengguna yang sudah login
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Dashboard (dengan controller)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Profil pengguna
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // CRUD Produk
    Route::resource('/products', ProdukController::class);
    Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
    Route::get('/dashboard/produk', [ProdukController::class, 'index'])->name('produk.index');


    // CRUD Kategori
    Route::resource('/categories', KategoriController::class);

     Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
    Route::post('/cart/{produk}', [CartController::class, 'add'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::delete('/cart/{produkId}', [CartController::class, 'remove'])->name('cart.remove');

    //wallet
    Route::post('/wallet/topup', [\App\Http\Controllers\DashboardController::class, 'topUpWallet'])->name('wallet.topup');
    Route::post('/wallet/topup', [DashboardController::class, 'topUpWallet'])->name('wallet.topup');

});
