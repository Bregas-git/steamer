<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Admin\ProductsController;

Route::post('/', function () {
    return view('/login');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {

    Route::get('/', [UserController::class, 'index'])->name('index');

    // BUYER ROUTE GROUP
    Route::group(['prefix' => 'user', 'as' => 'user.'], function () {});


    // SELLER ROUTE GROUP
    Route::group(['prefix' => 'seller', 'as' => 'seller.'], function () {
        Route::get('/products', [ProductController::class, 'index'])->name('index.product'); //seller.index.product
        Route::get('/product/register-product', [ProductController::class, 'create'])->name('create.product'); //seller.create.product
        Route::post('/product/register-product/save', [ProductController::class, 'save'])->name('save.product'); //seller.save.product
        Route::get('/product/view-product/{id}', [ProductController::class, 'show'])->name('show.product'); //seller.show.product
        Route::get('/product/edit-product/{id}', [ProductController::class, 'edit'])->name('edit.product'); //seller.edit.product
        Route::patch('/product/update-product/{id}', [ProductController::class, 'update'])->name('update.product'); //seller.update.product

    });

    // ADMIN ROUTE GROUP
    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {

        Route::get('/products', [ProductsController::class, 'index'])->name('index.product'); //admin.index.product
    });
});
