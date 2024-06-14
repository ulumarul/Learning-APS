<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WalletController;

Route::get('/', [\App\Http\Controllers\ProductController::class, 'index'])->name('product.index');
Route::post('/buy', [\App\Http\Controllers\ProductController::class, 'buy'])->name('product.buy');
Route::post('/wishlist', [\App\Http\Controllers\ProductController::class, 'wishlist'])->name('product.wishlist');

Route::get('/wallet', [WalletController::class, 'index'])->name('wallet.index');
Route::post('/wallet/topup', [WalletController::class, 'topup'])->name('wallet.topup');