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
    Route::get('/add-category', [Controllers\CategoriesController::class, 'showCategoryForm'])->name('category.add');

    Route::post('/category', [Controllers\CategoriesController::class, 'saveCategory'])->name('category.save');

    Route::get('/products', [Controllers\ProductsController::class, 'showProducts'])->name('products');

    Route::get('/auctions', [Controllers\AuctionsController::class, 'showAuctions'])->name('auctions');

    Route::post('/save-review', [Controllers\ReviewsController::class, 'saveReview'])->name('reviews.save');


});


