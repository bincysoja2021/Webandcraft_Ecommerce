<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//category
Route::get('/list_category', [App\Http\Controllers\CategoryController::class, 'index'])->name('list_category');
Route::get('/add_category', [App\Http\Controllers\CategoryController::class, 'add_category'])->name('add_category');
Route::post('/store', [App\Http\Controllers\CategoryController::class, 'store'])->name('store');
Route::get('/edit/{id}', [App\Http\Controllers\CategoryController::class, 'edit'])->name('edit');
Route::get('/update/{id}', [App\Http\Controllers\CategoryController::class, 'update'])->name('update');
Route::delete('/destroy/{id}', [App\Http\Controllers\CategoryController::class, 'destroy'])->name('destroy');


//product

Route::get('/list_product', [App\Http\Controllers\ProductController::class, 'index'])->name('list_product');
Route::get('/add_product', [App\Http\Controllers\ProductController::class, 'add_product'])->name('add_product');
Route::post('/product_store', [App\Http\Controllers\ProductController::class, 'store'])->name('product_store');
Route::get('/product_edit/{id}', [App\Http\Controllers\ProductController::class, 'edit'])->name('product_edit');
Route::get('/product_update/{id}', [App\Http\Controllers\ProductController::class, 'update'])->name('product_update');
Route::delete('/product_destroy/{id}', [App\Http\Controllers\ProductController::class, 'destroy'])->name('product_destroy');


//order

Route::get('/list_order', [App\Http\Controllers\OrderController::class, 'index'])->name('list_order');
Route::get('/add_order', [App\Http\Controllers\OrderController::class, 'add_order'])->name('add_order');
Route::post('/order_store', [App\Http\Controllers\OrderController::class, 'store'])->name('order_store');
Route::get('/order_edit/{id}', [App\Http\Controllers\OrderController::class, 'edit'])->name('order_edit');
Route::get('/order_invoice/{id}', [App\Http\Controllers\OrderController::class, 'invoice'])->name('order_invoice');
Route::get('/order_update/{id}', [App\Http\Controllers\OrderController::class, 'update'])->name('order_update');
Route::delete('/order_destroy/{id}', [App\Http\Controllers\OrderController::class, 'destroy'])->name('order_destroy');

