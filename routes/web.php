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
    return view('test');
});

Route::get('/donations_table', function () {
    return view('donationsTable');
});

Route::get('/goods_table', function () {
    return view('goodsTable');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/donations', 'DonationsController');
Route::resource('/goods', 'GoodsController');