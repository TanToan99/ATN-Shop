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
Route::group(['namespace' => 'Admin\Api'], function(){
	Route::get('/categories', [
			'as' => "categories.index",
			'uses' => "CategoryController@index"
		]);
	Route::get('/categories/search', [
			'as' => 'categories.search',
			'uses' => 'CategoryController@search'
		]);
	Route::get('/categories/showcategory', [
			'as' => 'categories.showcategory',
			'uses' => 'CategoryController@showcategory'
		]);
	Route::get('/categories/remote', [
			'as' => 'categories.remote',
			'uses' => 'CategoryController@remote'
		]);	
	Route::post('/categories/createpost', [
			'as' => 'categories.createpost',
			'uses' => 'CategoryController@createpost'
		]);
	Route::get('/categories/printfe', [
			'as' => 'categories.printfe',
			'uses' => 'CategoryController@printfe'
		]);
	Route::get('/categories/phantrang', [
			'as' => 'categories.phantrang',
			'uses' => 'CategoryController@phantrang'
		]);

	Route::get('/products', [
			'as' => 'products.index',
			'uses' => 'ProductController@index'
		]);
	Route::get('/products/search', [
			'as' => 'products.search',
			'uses' => 'ProductController@search'
		]);
	Route::get('/products/remote', [
			'as' => 'products.remote',
			'uses' => 'ProductController@remote'
		]);
	Route::get('/products/showproduct', [
			'as' => 'products.showproduct',
			'uses' => 'ProductController@showproduct'
		]);
	Route::post('/products/autocomplete', [
			'as' => 'products.autocomplete',
			'uses' => 'ProductController@autocomplete'
		]);
	Route::get('/orders/create_order', [
			'as' => 'orders.create_order',
			'uses' => 'OrderController@create_order'
		]);
	Route::post('/orders/action', [
			'as' => 'orders.action',
			'uses' => 'OrderController@action'
		]);	
	Route::post('/orders/remove', [
			'as' => 'orders.remove',
			'uses' => 'OrderController@remove'
		]);
	Route::get('/orders/checkqtt', [
			'as' => 'orders.checkqtt',
			'uses' => 'OrderController@checkqtt'
		]);
});
