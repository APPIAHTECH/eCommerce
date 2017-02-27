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

Route::bind('product',function($slug){
	return App\Product::where('slug',$slug)->first();
});

Route::get('/',[
  'as'=> 'home',
  'uses'=> 'StoreController@index'
]);


Route::get('product/{slug}',[
  'as'=> 'product-detail',
  'uses'=> 'StoreController@show'
]);

Route::get('/cart/show',[
		'as'=>'cart-show',
		'uses'=>'CartController@show'
]);

Route::get('/cart/add/{product}',[
			'as'=>'cart-add',
			'uses'=>'CartController@add'
]);


Route::get('/cart/delete/{product}',[
    'as'=>'cart-delete',
    'uses'=>'CartController@delete'
]);

Route::get('/cart/buidar',[
    'as'=>'cart-trash',
    'uses'=>'CartController@trash'
]);

Route::get('/cart/update/{product}/{quantity?}',[
    'as'=>'cart-update',
    'uses'=>'CartController@update'
]);

Route::get('order-detail',[
    'middleware'=>'auth',
    'as'=>'order-detail',
    'uses'=>'CartController@OrderDetail'
]);

Auth::routes();
Route::get('/home', 'HomeController@index');

Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout');


Route::get('payment',[
		'as' => 'payment',
	   'uses' => 'PaypalController@postPayment'
]);

Route::get('payment/status',[
		'as' => 'payment.status',
	   'uses' => 'PaypalController@getPaymentStatus'
]);

Route::resource('admin/category', 'admin\CategoryController');
Route::resource('admin/user', 'admin\UserController');
Route::resource('admin/product', 'admin\ProductController');

Route::bind('category',function($category){
    return App\Category::find($category);
});

Route::bind('user',function($user){
    return App\User::find($user);
});

Route::get('admin/home', function(){
    return view ('admin.home');
});
