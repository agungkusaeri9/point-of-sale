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

    // product categories
    Route::resource('categories', 'CategoryController')->except('show');

    // product units
    Route::resource('units', 'UnitController')->except('show');

    // product items
    Route::resource('items', 'ItemController')->except('show');
    Route::get('items/generator/{id}', 'ItemController@generator')->name('items.generator');
    Route::get('items/print/barcode/{id}', 'ItemController@print_barcode')->name('items.print.barcode');
    Route::get('items/print/qrcode/{id}', 'ItemController@print_qrcode')->name('items.print.qrcode');

    // stock
    Route::prefix('stocks')->name('stocks.')->group(function () {
        Route::resource('in', 'StockInController')->except('show');
        Route::resource('out', 'StockOutController')->except('show');
    });

    
    // transactions
    Route::get('sales', 'SaleController@index')->name('sales.index');
    Route::post('sales', 'SaleController@index')->name('sales.filter');
    Route::delete('sales/{id}', 'SaleController@destroy')->name('sales.destroy')->middleware('role:admin');
    Route::get('sales/checkout', 'SaleController@create')->name('sales.create');
    Route::post('sales/checkout', 'SaleController@store')->name('sales.store');

    // cart
    Route::post('cart', 'CartController@store')->name('cart.store');
    Route::delete('sales/checkout/{id}', 'CartController@destroy')->name('cart.destroy');
    Route::delete('cart/delete', 'CartController@deleteAll')->name('cart.deleteAll');

});

