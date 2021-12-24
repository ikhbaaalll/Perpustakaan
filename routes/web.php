<?php

use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoanController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\User\BookController as UserBookController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
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

Route::redirect('/', 'login');

Route::get('login', [LoginController::class, 'showLoginForm']);
Route::post('login', [LoginController::class, 'login'])->name('login');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('register',  [RegisterController::class, 'showRegistrationForm']);
Route::post('register',  [RegisterController::class, 'register'])->name('register');

Route::get('profile', [ProfileController::class, 'index'])->name('profile');
Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');

Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::resource('categories', CategoryController::class);
    Route::resource('categories.books', BookController::class);

    Route::get('loans', [LoanController::class, 'index'])->name('loan.index');
    Route::put('loan/{loan}', [LoanController::class, 'update'])->name('loan.update');

    Route::get('user', [UserController::class, 'index'])->name('user');
    Route::delete('user/{user}', [UserController::class, 'destroy'])->name('user.destroy');
});

Route::group(['middleware' => ['auth', 'user'], 'prefix' => 'user', 'as' => 'user.'], function () {
    Route::get('dashboard', UserDashboardController::class)->name('dashboard');

    Route::get('book', [UserBookController::class, 'index'])->name('book');
    Route::post('book', [UserBookController::class, 'store'])->name('book.rent');
    Route::get('book/history', [UserBookController::class, 'history'])->name('book.history');
});
