<?php

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

Route::prefix('admin')->group(function () {
    
    //Products
    Route::resource('products', 'App\Http\Controllers\Admin\ProductController')->names('admin.products');

    //Users
    Route::resource('users', 'App\Http\Controllers\Admin\UserController')->names('admin.users');
    
    //Orders
    Route::resource('orders', 'App\Http\Controllers\Admin\OrderController')->names('admin.orders');
    
    //Packages
    Route::get('/packages/create/{id}', [App\Http\Controllers\Admin\PackageController::class,'create'])->name('admin.packages.create');
    Route::resource('packages', 'App\Http\Controllers\Admin\PackageController')->names('admin.packages');
});