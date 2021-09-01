<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\TransactionController;

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

Auth::routes();

Route::resource('units', UnitController::class);
Route::resource('paymentmethods', PaymentMethodController::class);
Route::resource('accounts', AccountController::class);
Route::resource('transactions', TransactionController::class);
Route::get('/report', [App\Http\Controllers\TransactionController::class,'report'])->name('report');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
