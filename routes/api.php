<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['prefix' => 'setup'], function()
{
	Route::resource('category','Api\CategoryController');		
	Route::resource('city','Api\CityController');	
	Route::resource('township','Api\TownshipController');	
	Route::resource('fee','Api\FeeController');	
	Route::resource('restaurant','Api\UserDetailController');	
	Route::get('township_by_city','Api\UserDetailController@getTownshipByCity');
	Route::get('restaurant_by_township','Api\UserDetailController@getRestaurantsByTownship');
	Route::resource('feedback','Api\FeedbackController');	
	Route::resource('menu','Api\MenuController');
	Route::get('menus_by_restaurant','Api\MenuController@getMenusByRestaurant');	
	Route::resource('order','Api\OrderController');	
});
