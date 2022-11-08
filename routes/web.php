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

    Route::get('/edit-category/{id}', [App\Http\Controllers\CategoriesController::class, 'editCategoryForm'])->name('category.edit.form');

    Route::patch('/edit-category/{id}', [App\Http\Controllers\CategoriesController::class, 'editCategory'])->name('category.edit');

    Route::delete('/delete-category/{id}', [App\Http\Controllers\CategoriesController::class, 'deleteCategory'])->name('category.delete');

    Route::get('/manage-category', [App\Http\Controllers\CategoriesController::class, 'manageCategory'])->name('category.manage');

    Route::get('/get-category/{id}', [App\Http\Controllers\CategoriesController::class, 'getCategory'])->name('category.get');

    Route::get('/products', [App\Http\Controllers\ProductsController::class, 'showProducts'])->name('products');

    Route::get('/auctions', [App\Http\Controllers\AuctionsController::class, 'showAuctions'])->name('auctions');

    Route::post('/save-review', [App\Http\Controllers\ReviewsController::class, 'saveReview'])->name('reviews.save');


});


