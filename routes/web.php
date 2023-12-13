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
    
    //Order Detail
    Route::get('orderdetails/create/{order_id}', [App\Http\Controllers\Admin\OrderDetailController::class, 'create'])->name('admin.orderdetails.create');
    Route::resource('orderdetails', 'App\Http\Controllers\Admin\OrderDetailController')->names('admin.orderdetails');
   
    //Package User
    Route::get('/userproducts/create/{user_id}/{package_id}', [App\Http\Controllers\Admin\UserProductController::class,'create'])->name('admin.userproducts.create');
    Route::get('/userproducts/create3D/{user_id}/{package_id}', [App\Http\Controllers\Admin\UserProductController::class,'create3D'])->name('admin.userproducts.create3D');
    Route::post('/userproducts/storePro', [App\Http\Controllers\Admin\UserProductController::class,'storePro'])->name('admin.userproducts.storePro');
    Route::post('/userproducts/storeSingle', [App\Http\Controllers\Admin\UserProductController::class,'storeSingle'])->name('admin.userproducts.storeSingle');
    Route::post('/userproducts/store10', [App\Http\Controllers\Admin\UserProductController::class,'store10'])->name('admin.userproducts.store10');
    Route::post('/userproducts/store35', [App\Http\Controllers\Admin\UserProductController::class,'store35'])->name('admin.userproducts.store35');
    Route::get('/userproducts/showuser/{user_id}/{package_id}', [App\Http\Controllers\Admin\UserProductController::class,'show'])->name('admin.userproducts.showuser');
    // Show package user
    Route::resource('userproducts', 'App\Http\Controllers\Admin\UserProductController')->names('admin.userproducts');

    //Packages
    Route::get('/packages/create/{id}', [App\Http\Controllers\Admin\PackageController::class,'create'])->name('admin.packages.create');
    Route::resource('packages', 'App\Http\Controllers\Admin\PackageController')->names('admin.packages');
});