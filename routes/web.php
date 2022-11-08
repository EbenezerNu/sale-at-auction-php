<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {return redirect()->route('login');});

Auth::routes();

Route::middleware('auth')->group(function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    /*ROUTES FOR CATEGORIES*/

    Route::post('/add-category', [App\Http\Controllers\CategoriesController::class, 'addCategory'])->name('category.save');

    Route::get('/edit-category/{id}', [App\Http\Controllers\CategoriesController::class, 'editCategoryForm'])->name('category.edit.form');

    Route::patch('/edit-category/{id}', [App\Http\Controllers\CategoriesController::class, 'editCategory'])->name('category.edit');

    Route::delete('/delete-category/{id}', [App\Http\Controllers\CategoriesController::class, 'deleteCategory'])->name('category.delete');

    Route::get('/manage-category', [App\Http\Controllers\CategoriesController::class, 'manageCategory'])->name('category.manage');

    /* ROUTES FOR PRODUCTS*/

    Route::get('/manage-products', [App\Http\Controllers\ProductsController::class, 'manageProducts'])->name('product.manage');

    Route::post('/add-product', [App\Http\Controllers\ProductsController::class, 'addProduct'])->name('product.save');

    Route::get('/edit-product/{id}', [App\Http\Controllers\ProductsController::class, 'editProductForm'])->name('product.edit.form');

    Route::get('/view-product/{id}', [App\Http\Controllers\ProductsController::class, 'getProduct'])->name('product.view');

    Route::patch('/edit-product/{id}', [App\Http\Controllers\ProductsController::class, 'editProduct'])->name('product.edit');

    Route::delete('/delete-product/{id}', [App\Http\Controllers\ProductsController::class, 'deleteProduct'])->name('product.delete');

    /* ROUTES FOR AUCTIONS*/

    Route::get('/manage-auctions', [App\Http\Controllers\AuctionsController::class, 'manageAuctions'])->name('auction.manage');

    Route::get('/get-category/{id}', [App\Http\Controllers\CategoriesController::class, 'getCategory'])->name('category.get');

    Route::get('/products', [App\Http\Controllers\ProductsController::class, 'showProducts'])->name('products');

    Route::get('/auctions', [App\Http\Controllers\AuctionsController::class, 'showAuctions'])->name('auctions');

    Route::post('/add-review/{id}', [App\Http\Controllers\ReviewsController::class, 'addReview'])->name('reviews.save');


});


