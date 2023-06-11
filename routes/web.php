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

// CardCpntroller
use App\Http\Controllers\CardController;
Route::controller(CardController::class)->prefix('card')->name('card.')->group(function(){
    Route::post('create', 'create')->name('create');
    Route::post('edit', 'edit')->name('edit');
    Route::get('delete', 'delete')->name('delete');
    Route::get('process_image', 'processImage')->name('process_image');
});

// QuizController
use App\Http\Controllers\QuizController;
Route::controller(QuizController::class)->prefix('quiz')->name('quiz.')->group(function(){
    Route::get('/question', 'question')->name('question');
    Route::post('/result', 'result')->name('result');
    Route::get('/result', 'resultView')->name('result_view');
});

// Auth
use Illuminate\Support\Facades\Auth;
Auth::routes();
use App\Http\Controllers\Auth\LoginController;
Route::controller(LoginController::class)->prefix('login')->name('login.')->group(function(){
    Route::get('google', 'redirectToGoogle')->name('google.redirect');
    Route::get('google/callback', 'handleGoogleCallback')->name('google.callback');
});

// Admin
use App\Http\Controllers\AdminController;
Route::controller(AdminController::class)->middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/users', 'users')->name('users');
        Route::get('/books', 'books')->name('books');
        Route::get('/cards', 'cards')->name('cards');
    });

// HomeController
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
