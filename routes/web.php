<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home');
Route::get('/dev', 'App\Http\Controllers\TestController@dev')->name('dev');
Route::get('/privacy-policy', 'App\Http\Controllers\PrivacyController@index')->name('policy.show');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
    Route::get('/users', 'App\Http\Controllers\UserController@index')->name('users.index');
    Route::get('/orders', 'App\Http\Controllers\OrderController@index')->name('orders.index');
    Route::get('/order/{id}', 'App\Http\Controllers\OrderController@show')->name('orders.show');
    Route::post('/order/update', 'App\Http\Controllers\OrderController@update')->name('orders.update');
    Route::post('/order/buy', 'App\Http\Controllers\OrderController@buy')->name('orders.buy');
    Route::post('/order/delete', 'App\Http\Controllers\OrderController@delete')->name('orders.delete');
    Route::get('/products', 'App\Http\Controllers\ProductController@index')->name('products.index');
    Route::get('/product/new', 'App\Http\Controllers\ProductController@newProduct')->name('products.new');
    Route::post('/product/create', 'App\Http\Controllers\ProductController@create')->name('products.create');
    Route::post('/product/comment', 'App\Http\Controllers\ProductController@comment')->name('products.comment');
    Route::get('/product/buy/{id}', 'App\Http\Controllers\ProductController@buy')->name('products.buy');
    Route::get('/product/{id}', 'App\Http\Controllers\ProductController@show')->name('products.show');
});
