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

Route::get('/','CategoryController@index')->name('category');
Route::resource('category','CategoryController');
Route::resource('city','CityController');
Route::resource('township','TownshipController');
Route::resource('fee','FeeController');
Route::resource('user_detail','UserDetailController');
Route::resource('feedback','FeedbackController');
Route::resource('menu','MenuController');
Route::resource('item','ItemController');
Route::resource('shop','ShopController');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
