<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CategoriesController;
use App\Http\Controllers\API\OrdersController;
use App\Http\Controllers\API\ProductsController;
use App\Models\User;
use Illuminate\Support\Facades\Route;


Route::post('login', [AuthController::class, 'login']);
Route::get('/get/products', [ProductsController::class, 'index']);
Route::post('/place/order', [OrdersController::class, 'placeOrder']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('register', [AuthController::class, 'register']);

    // Category
    Route::resource('category', CategoriesController::class);
    Route::resource('product', ProductsController::class);
});
