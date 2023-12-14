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
    Route::get('/userproducts/create3d/{user_id}/{package_id}', [App\Http\Controllers\Admin\UserProductController::class,'create3d'])->name('admin.userproducts.create3d');

    Route::get('/userproducts/showuser/{user_id}/{package_id}', [App\Http\Controllers\Admin\UserProductController::class,'show'])->name('admin.userproducts.showuser');
    
    // Show package single
    Route::get('userproducts/edit3d/{id}', [App\Http\Controllers\Admin\UserProductController::class,'edit3d'])->name('admin.userproducts.edit3d');
    
    Route::resource('userproducts', 'App\Http\Controllers\Admin\UserProductController')->names('admin.userproducts');
    

    //Packages
    Route::get('/packages/create/{id}', [App\Http\Controllers\Admin\PackageController::class,'create'])->name('admin.packages.create');
    Route::resource('packages', 'App\Http\Controllers\Admin\PackageController')->names('admin.packages');
});