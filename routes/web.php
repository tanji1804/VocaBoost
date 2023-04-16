<?php

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

// TopController
Route::get('/', [App\Http\Controllers\TopController::class, 'index'])->name('top');

// BookController
use App\Http\Controllers\BookController;
Route::controller(BookController::class)->prefix('book')->name('book.')->middleware('auth')->group(function(){
    Route::post('create','create')->name('create');
    Route::post('edit', 'edit')->name('edit');
    Route::get('delete', 'delete')->name('delete');
});
Route::get('book', [App\Http\Controllers\BookController::class, 'index'])->name('book.index');

// Auth
Auth::routes();

// HomeController
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
