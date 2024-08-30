<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [AppController::class, 'index']);

Route::get('/cart', [CartController::class, 'cartView']);
Route::get('/add-to-cart/{product_id}', [CartController::class, 'addToCart'])->name('addToCart');
Route::get('/remove-from-cart/{product_id}', [CartController::class, 'removeFromCart'])->name('removeFromCart');
Route::get('/combine-to-cart/{product_id_1}/{product_id_2}', [CartController::class, 'combineToCart'])->name('combineToCart');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
