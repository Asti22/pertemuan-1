<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductApiController;

// Rute Login untuk dapat token
Route::post('/login', [AuthController::class, 'login']);

// Rute yang butuh login (pake token)
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('categories', CategoryController::class);
    // Tambahkan resource lain yang butuh login di sini
});
Route::apiResource('products', ProductApiController::class);
