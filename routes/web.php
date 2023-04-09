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

Route::get('/', function () {
    return view('welcome');
});


// BookController
use App\Http\Controllers\BookController;
Route::controller(BookController::class)->prefix('book')->name('book.')->group(function(){
    Route::get('create', 'add')->name('add');
    Route::post('create','create')->name('create');
    Route::get('edit', 'edit')->name('edit');
    Route::post('edit', 'update')->name('update');
    Route::get('delete', 'delete')->name('delete');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
