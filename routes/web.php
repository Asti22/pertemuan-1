<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BiodataController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/about', [BiodataController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('about');

Route::middleware('auth')->group(function () {
    // === Profile Routes ===
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // === Product Routes ===
    // Semua user login bisa mengakses index dan detail
    Route::get('/product', [ProductController::class, 'index'])->name('product.index');
    Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/product', [ProductController::class, 'store'])->name('product.store');
    Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');
    Route::get('/product/edit/{product}', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('/product/update/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/product/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');

    // Rute Export dilindungi oleh Gate 'export-product' di Controller
    Route::get('/product/export', [ProductController::class, 'export'])->name('product.export');

    // === Category Routes (PROTECTED) ===
    // Hanya Admin yang bisa mengakses (Memvalidasi Gate 'access-category')
    Route::middleware('can:access-category')->group(function () {
        Route::resource('category', CategoryController::class);
    });
});

require __DIR__.'/auth.php';