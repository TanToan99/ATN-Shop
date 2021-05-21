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

// Route frontend
Route::get('/', 'HomeController@index')->name('home.index');

Route::get('/product', 'HomeController@product')->name('home.product');
Route::get('/contact', 'HomeController@contact')->name('home.contact');
Route::post('/contact', 'HomeController@sendContact')->name('home.sendcontact');

Route::get('/product/{id}', 'HomeController@product')->name('home.product');
Route::get('home/showAllProduct', 'HomeController@showAllProduct')->name('home.showAllProduct');
Route::get('home/{id}/showproduct', [
	'as' => 'categories.showproduct',
	'uses' => 'CategoryController@showproduct'
]);
Route::post('/autocomplete', [
	'as' => 'home.autocomplete',
	'uses' => 'HomeController@autocomplete'
]);
Route::post('/show_product/{id}', [
	'as' => 'home.show_product',
	'uses' => 'HomeController@show_product'
]);
Route::get('/checkorder', [
	'as' => 'home.checkorder',
	'uses' => 'HomeController@checkorder'
]);
Route::get('products/compare', [
	'as' => 'home.sosanh',
	'uses' => 'ProductController@sosanh'
]);
//cellphone.com/products/compare?pd_1=1&pd_2=2

// Route::resource('admin/products', 'Admin\ProductController');
// Route::resource('orders', 'OrderController');
//Route::get('/', 'HomeController@index')->name('home.index');



// Auth::routes();

Route::group(['prefix' => 'admin','namespace' => 'Admin', 'middleware' => 'admin-login'], function(){
	Route::get('/', 'PageController@index')->name('admin.index');
	Route::resource('/categories', 'CategoryController');
	Route::get('categories/{id}/showcategory', [
		'as' => "category.showcategory",
		'uses' => "CategoryController@showcategory"
	]);	
	Route::get('categories/{id}/showproducts', [
		'as' => "category.showproducts",
		'uses' => "CategoryController@showproducts"
	]);	
	Route::resource('/products', 'ProductController');
	Route::get('/orders/{order}/active', [
			'as' => "orders.active",
			'uses' => "OrderController@active"
		]);
	Route::get('/orders/{order}/payment', [
			'as' => "orders.payment",
			'uses' => "OrderController@payment"
		]);
	Route::resource('/orders', 'OrderController');
	Route::resource('/users', 'UserController');
	// Route::get('/users/search', 'UserController@search')->name('users.search');
	Route::get('/dashboard','PageController@dashboard')->name('admin.dashboard');
	Route::group(['prefix' => 'comments', 'as' => 'comments.'], function(){
		Route::get('/', 'CommentController@index')->name('index');
		Route::get('/approve/{id}', 'CommentController@approve')->name('approve');
		Route::get('/remove/{id}', 'CommentController@remove')->name('remove');
		Route::get('/show/{id}', 'CommentController@show')->name('show');
		Route::get('/search', 'CommentController@search')->name('search');
	});
	Route::resource('/slides', 'SlideController');
});

Route::post('create-comment','Admin\CommentController@create')->name('comments.create')->middleware('check-login');

// Route login Admin
Route::group(['prefix' => 'admin', 'namespace' => 'Loginadmin', 'as' => 'admin.'], function(){
	Route::get('/login', 'LoginController@login')->name('login');
	Route::post('/login', 'LoginController@showLogin')->name('showlogin');
	Route::get('/logout', 'LoginController@logout')->name('logout');
});

// Route login user
Route::group(['prefix' => '/', 'namespace' => 'Loginuser', 'as' => 'users.'], function(){
	Route::get('/login', 'LoginController@login')->name('login');
	Route::post('/login', 'LoginController@showLogin')->name('showlogin');
	Route::get('/logout', 'LoginController@logout')->name('logout');
	Route::get('/register', 'LoginController@register')->name('register');
	Route::post('/register', 'LoginController@showRegister')->name('showregister');

});
Route::get('users/cart/{id}', [
	'as' => 'users.cart',
	'uses' => 'HomeController@cart'
])->middleware('check-login');
Route::get('home/showorder/{id}', [
	'as' => 'home.showorder',
	'uses' => 'HomeController@showorder'
])->middleware('check-login');

Route::post('home/orderdetail', [
	'as' => 'home.orderdetail',
	'uses' => 'HomeController@orderdetail'
])->middleware('check-login');
Route::get('home/action/{id}', [
	'as' => 'home.action',
	'uses' => 'HomeController@action'
])->middleware('check-login');
Route::get('order/kiemtradonhang/{id}', [
	'as' => 'order.kiemtradonhang',
	'uses' => 'OrderController@kiemtradonhang'
])->middleware('check-login');
// Fix loi
Route::get('users/search', 'Admin\UserController@search')->name('users.search');