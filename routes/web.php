<?php

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

use Illuminate\Support\Facades\Route;
//use Illuminate\Support\Facades\Session;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'PageController@indexView');
Route::get('/category/{id}', 'PageController@categoryView');
Route::get('/product/{id}', 'PageController@productView');
Route::get('/contact', 'PageController@contactView');
Route::get('/about', 'PageController@aboutView');
Route::get('/add-to-cart/{id}', 'PageController@addToCart');
Route::get('/delete-item-cart/{id}', 'PageController@deleteItemCart');
Route::get('/order', 'PageController@orderView');
Route::post('/order', 'PageController@order');
Route::get('/login', 'PageController@loginView');
Route::post('/login', 'PageController@login');
Route::get('/register', 'PageController@registerView');
Route::post('/register', 'PageController@register');
Route::get('/logout', 'PageController@logout');
Route::get('/search', 'PageController@search');