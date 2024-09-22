<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/auth/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    //Product Route
    Route::get('/products', [ProductController::class, 'getAllProducts']);
    Route::get('/product/{product:id}', [ProductController::class, 'productDetail']);

    //Cart Route
    Route::get('/carts', [CartController::class, 'getAllCart']);
    Route::post('/cart/create', [CartController::class, 'addCartData']);

    //Profile Route
    Route::get('/me', [AuthController::class, 'dataMe']);

    //Authorization
    Route::get('/auth/logout', [AuthController::class, 'logout']);

});
