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
    //routes for notebooks
    Route::post('/add-category', [App\Http\Controllers\CategoriesController::class, 'addCategory'])->name('category.save');

    Route::patch('/edit-category', [App\Http\Controllers\CategoriesController::class, 'editCategory'])->name('category.edit');

    Route::get('/manage-category', [App\Http\Controllers\CategoriesController::class, 'manageCategory'])->name('category.manage');

    Route::post('/category', [App\Http\Controllers\CategoriesController::class, 'saveCategory'])->name('category.save');

    Route::get('/products', [App\Http\Controllers\ProductsController::class, 'showProducts'])->name('products');

    Route::get('/auctions', [App\Http\Controllers\AuctionsController::class, 'showAuctions'])->name('auctions');

    Route::post('/save-review', [App\Http\Controllers\ReviewsController::class, 'saveReview'])->name('reviews.save');


});


