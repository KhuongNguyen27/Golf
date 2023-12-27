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
Route::group([
    'prefix'=>'admin',
    'middleware' => 'preventhistory',
    'as' => 'admin.'
],function(){
    Route::get('/',function(){
        return redirect()->route('packages.index');
    });
    
    // ------------------------ 
    //Products
    Route::resource('products', 'App\Http\Controllers\Admin\ProductController')->names('products');

    //Users
    Route::resource('users', 'App\Http\Controllers\Admin\UserController')->names('users');
    
    //Orders
    Route::resource('orders', 'App\Http\Controllers\Admin\OrderController')->names('orders');
    
    //Order Detail
    Route::get('orderdetails/create/{order_id}', [App\Http\Controllers\Admin\OrderDetailController::class, 'create'])->name('orderdetails.create');
    Route::resource('orderdetails', 'App\Http\Controllers\Admin\OrderDetailController')->names('orderdetails');
    // ------------------------ 

    //Packages
    Route::get('/packages', [App\Http\Controllers\Admin\PackageController::class,'index'])->name('packages.index');

    //Package User
    Route::get('/packageusers/{package_id}', [App\Http\Controllers\Admin\PackageUserController::class,'index'])->name('packageusers.index');
    Route::get('/packageusers/create/{package_id}', [App\Http\Controllers\Admin\PackageUserController::class,'create'])->name('packageusers.create');
    Route::post('/packageusers/store', [App\Http\Controllers\Admin\PackageUserController::class,'store'])->name('packageusers.store');
    Route::delete('/packageusers/destroy/{id}', [App\Http\Controllers\Admin\PackageUserController::class,'destroy'])->name('packageusers.destroy');

    //User Product
    Route::get('/userproducts/index/{package_user_id}', [App\Http\Controllers\Admin\UserProductController::class,'index'])->name('userproducts.index');
    Route::get('/userproducts/create/{package_user_id}', [App\Http\Controllers\Admin\UserProductController::class,'create'])->name('userproducts.create');
    Route::get('/userproducts/create3d/{package_user_id}', [App\Http\Controllers\Admin\UserProductController::class,'create3d'])->name('userproducts.create3d');
    Route::get('/userproducts/edit3d/{id}', [App\Http\Controllers\Admin\UserProductController::class,'edit3d'])->name('userproducts.edit3d');
    Route::post('/userproducts/store', [App\Http\Controllers\Admin\UserProductController::class,'store'])->name('userproducts.store');
    
    // Expiration 1 day
    Route::get('/expirations/create/{id}', [App\Http\Controllers\Admin\ExpirationController::class,'create'])->name('expirations.create');
    Route::post('/expirations/store', [App\Http\Controllers\Admin\ExpirationController::class,'store'])->name('expirations.store');
    Route::get('/expirations/{package_user_id}', [App\Http\Controllers\Admin\ExpirationController::class,'show'])->name('expirations.show');
    Route::get('/expirations/edit/{id}', [App\Http\Controllers\Admin\ExpirationController::class,'edit'])->name('expirations.edit');
    Route::put('/expirations/update/{id}', [App\Http\Controllers\Admin\ExpirationController::class,'update'])->name('expirations.update');
    Route::delete('/expirations/destroy/{id}', [App\Http\Controllers\Admin\ExpirationController::class,'destroy'])->name('expirations.destroy');
    
    //PDF
    Route::get('/pdf/create/{id}',[App\Http\Controllers\Admin\PdfController::class,'create'])->name('pdf.create');
});