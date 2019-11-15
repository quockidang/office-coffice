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

Route::post('login', 'Api\UserController@login');
Route::post('register', 'Api\UserController@store');
Route::group(['middleware' => ['auth:api']], function(){
    Route::post('details', 'Api\UserController@details');
    Route::post('update', 'Api\UserController@update');
    Route::post('orders', 'OrderController@order');
    Route::post('historyorder', 'OrderController@historyorder');
    Route::post('historyorderdetails', 'OrderController@historyorderdetails');
});
Route::get('products/{id}', 'Api\ProductController@GetProductByCategory');
//Route::get('products', 'Api\ProductController@index');
Route::get('categories', 'Api\CategoryController@index');
Route::get('product/{id}', 'Api\ProductController@GetProductById');

