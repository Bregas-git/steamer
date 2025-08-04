<?php

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\Admin\ProductsController;

Route::post('/', function () {
    return view('/login');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {

    Route::get('/', [UserController::class, 'index'])->name('index');

    Route::patch('/user/add-balance', [UserController::class, 'addBalance'])->name('add.balance');
    Route::patch('/user/buy-product/{id}', [TransactionController::class, 'buyProduct'])->name('buy.product');

    Route::get('/user/cart', [TransactionController::class, 'cartIndex'])->name('cart.index');

    Route::patch('/user/cart/pay', [TransactionController::class, 'makePayment'])->name('cart.pay');

    Route::get('/user/profile', [UserController::class, 'profile'])->name('profile');
    Route::get('/user/edit', [UserController::class, 'edit'])->name('profile.edit');
    Route::patch('/user/update', [UserController::class, 'update'])->name('profile.update');

    Route::get('/user/library', [TransactionController::class, 'library'])->name('library');
    // BUYER ROUTE GROUP
    // Route::group(['prefix' => 'user', 'as' => 'user.'], function () {});


    // SELLER ROUTE GROUP
    Route::group(['prefix' => 'seller', 'as' => 'seller.'], function () {
        Route::get('/products', [ProductController::class, 'index'])->name('index.product'); //seller.index.product
        Route::get('/product/register-product', [ProductController::class, 'create'])->name('create.product'); //seller.create.product
        Route::post('/product/register-product/save', [ProductController::class, 'save'])->name('save.product'); //seller.save.product
        Route::get('/product/view-product/{id}', [ProductController::class, 'show'])->name('show.product'); //seller.show.product
        Route::get('/product/edit-product/{id}', [ProductController::class, 'edit'])->name('edit.product'); //seller.edit.product
        Route::patch('/product/update-product/{id}', [ProductController::class, 'update'])->name('update.product'); //seller.update.product

        // News Route
        Route::get('/news', [NewsController::class, 'index'])->name('news.index'); //seller.news.index
        Route::get('/news/create', [NewsController::class, 'create'])->name('news.create'); //seller.news.create
        Route::post('/news/store', [NewsController::class, 'store'])->name('news.store'); //seller.news.store
        Route::get('/news/view/{id}', [NewsController::class, 'view'])->name('news.view'); //seller.news.view
        Route::get('/news/edit/{id}', [NewsController::class, 'edit'])->name('news.edit'); //seller.news.edit
    });

    // ADMIN ROUTE GROUP
    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {

        Route::get('/control', [HomeController::class, 'admControl'])->name('control'); //admin.control

        // Users Route
        Route::get('/users', [UsersController::class, 'index'])->name('users.index'); //admin.users.index
        Route::patch('/users/{id}/toAdmin', [UsersController::class, 'switchAdmin'])->name('user.to.admin'); //admin.user.to.admin
        Route::patch('/users/{id}/toBuyer', [UsersController::class, 'switchBuyer'])->name('user.to.buyer'); //admin.user.to.buyer
        Route::patch('/users/{id}/toSeller', [UsersController::class, 'switchSeller'])->name('user.to.seller'); //admin.user.to.seller

        Route::delete('/user/{id}/deactivate', [UsersController::class, 'deactivate'])->name('user.deactivate'); //admin.user.deactivate
        Route::patch('/user/{id}/activate', [UsersController::class, 'activate'])->name('user.activate'); //admin.user.activate


        //Categories route
        Route::get('/categories', [CategoriesController::class, 'index'])->name('categories.index'); //admin.categories.index
        Route::post('/categories/create', [CategoriesController::class, 'create'])->name('categories.create'); //admin.categories.create
        Route::patch('/categories/edit/{id}', [CategoriesController::class, 'edit'])->name('categories.edit'); //admin.categories.edit

        //Products route
        Route::get('/products', [ProductsController::class, 'index'])->name('index.product'); //admin.index.product
        Route::get('/products/inspect/{id}', [ProductsController::class, 'show'])->name('inspect.product'); //admin.inspect.product
        Route::patch('/products/reject/{id}', [ProductsController::class, 'reject'])->name('reject.product'); //admin.reject.product
        Route::patch('/products/approve/{id}', [ProductsController::class, 'approve'])->name('approve.product'); //admin.approve.product

    });
});
