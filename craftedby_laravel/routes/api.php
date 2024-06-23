<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AddressController;
use Spatie\Permission\Models\Permission;


use App\Http\Resources\UserCollection;
use App\Models\User;

// Public routes accessible to all users
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{product}', [ProductController::class, 'show']);
Route::post('/products', [ProductController::class, 'store'])->middleware('auth:sanctum');


Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
Route::put('/products/{product}', [ProductController::class, 'update']);

// Route to get products by category
Route::get('/products/category/{category}', [ProductController::class, 'getProductsByCategory']);

// Route to search products by keyword
Route::get('products/search/{keyword}', [ProductController::class, 'search']);




Route::post('/users/{user_id}/shops', 'ShopController@store');




//User
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/user/{id}', [UserController::class, 'show']);

    Route::delete('/user/{id}', [UserController::class, 'destroy']);
    Route::put('/user/{id}', [UserController::class, 'update']);

    Route::get('users/{id}/addresses', [UserController::class, 'getUserAddresses']);

});

//order
Route::post('create_order', [OrderController::class, 'create']);
Route::get('orders', [OrderController::class, 'index']);
Route::delete('orders/{id}', [OrderController::class, 'delete']);
Route::get('user/{userId}/orders', [OrderController::class, 'ordersByUser']);

//adresse
Route::get('addresses', [AddressController::class, 'index']);
Route::post('addresses', [AddressController::class, 'store']);
Route::delete('addresses/{id}', [AddressController::class, 'destroy']);

//Route::get('/users', function () {
//    return new UserCollection(User::all());
//})->middleware('auth:sanctum');
