<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Api\ApiController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// get categories
Route::get('get/categories', [ApiController::class, 'categories']);
// get contacts
Route::get('get/contacts', [ApiController::class, 'contacts']);
// get order
Route::get('get/orders', [ApiController::class, 'orders']);
// get order list
Route::get('get/orderLists', [ApiController::class, 'orderLists']);
// get products
Route::get('get/products', [ApiController::class, 'products']);
// get users
Route::get('get/users', [ApiController::class, 'users']);

// create categories
Route::post('create/categories', [ApiController::class, 'createCategories']);

// delete categories (method 1)
Route::post('delete/categories', [ApiController::class, 'deleteCategories']);
// delete categories (method 2)
Route::get('delete/categories/{id}', [ApiController::class, 'delete']);