<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CategoriesController;
use App\Http\Controllers\API\OrdersController;
use App\Http\Controllers\API\ProductsController;
use App\Http\Controllers\API\SalesController;
use App\Http\Controllers\API\UserController;
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
    Route::post('update/product', [ProductsController::class, 'updateProduct']);
    Route::post('delete/product', [ProductsController::class, 'deleteProduct']);

    Route::get('all/orders', [OrdersController::class, 'getAllOrders']);
    Route::post('make/payment', [OrdersController::class, 'makePayment']);
    Route::post('complete/order', [OrdersController::class, 'completeOrder']);

    Route::get('all/users', [UserController::class, 'getAllUsers']);
    Route::post('user', [UserController::class, 'store']);
    Route::post('update/user', [UserController::class, 'updateUser']);
    Route::post('delete/user', [UserController::class, 'deleteUser']);

    Route::get('product', [ProductsController::class, 'getAllProducts']);
    Route::get('orders/count', [OrdersController::class, 'getCount']);

    Route::get('daily/sales', [SalesController::class], 'getDailySales');
});
