<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CategoriesController;
use App\Http\Controllers\API\OrdersController;
use App\Http\Controllers\API\ProductsController;
use App\Http\Controllers\API\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;


Route::post('login', [AuthController::class, 'login']);
Route::get('/get/products', [ProductsController::class, 'index']);
Route::post('/place/order', [OrdersController::class, 'placeOrder']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('register', [AuthController::class, 'register']);

    // Category
    Route::resource('category', CategoriesController::class);
    Route::post('update/category', [CategoriesController::class, 'updateCategory']);
    Route::post('delete/category', [CategoriesController::class, 'deleteCategory']);
    Route::resource('product', ProductsController::class);
    Route::get('all/orders', [OrdersController::class, 'getAllOrders']);
    Route::post('make/payment', [OrdersController::class, 'makePayment']);
    Route::post('complete/order', [OrdersController::class, 'completeOrder']);

    Route::get('all/users', [UserController::class, 'getAllUsers']);
    Route::get('product', [ProductsController::class, 'getAllProducts']);
    Route::get('orders/count', [OrdersController::class, 'getCount']);
});
