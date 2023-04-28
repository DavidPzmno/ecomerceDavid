<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/', [ProductController::class, 'show'])->name("index");

Route::get('/carts', [CartController::class, 'show'])->name("carts");

Route::get('/carts/create', [CartController::class, 'create'])->name("cart.create");

Route::post('/carts/store', [CartController::class, 'store'])->name("cart.store");

Route::get('/carts/delete/{id}', [CartController::class, 'delete'])->name("cart.delete");

Route::get('/carts/detail/{id}', [CartController::class, 'detail'])->name("carts.detail");

Route::get('/carts/edit/{id}', [CartController::class, 'edit'])->name("carts.edit"); 

Route::post('/carts/removeProducts', [CartController::class, 'removeProducts'])->name("cart.removeProducts");
