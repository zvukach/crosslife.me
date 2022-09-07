<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/catalog', ['App\Http\Controllers\Api\ProductsController', 'index'])->name('products.index');
Route::post('/create-order', ['App\Http\Controllers\Api\OrdersController', 'store'])->name('orders.store');
Route::post('/approve-order ', ['App\Http\Controllers\Api\OrdersController', 'approveOrder'])->name('orders.approve-order');
