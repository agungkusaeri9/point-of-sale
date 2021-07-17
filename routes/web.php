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
Route::redirect('/', '/dashboard', 301);

Auth::routes(['register' => false]);

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard','DashboardController@index')->name('dashboard');
    // users
    Route::resource('users', 'UserController')->except('show')->middleware('role:admin');

    // suppliers
    Route::resource('suppliers', 'SupplierController')->except('show');

    // customers
    Route::resource('customers', 'CustomerController')->except('show');
});

