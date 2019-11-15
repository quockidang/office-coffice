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



Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth', 'is_admin']], function () {

    Route::get('/dashboard', function () {
        return view('backend.dashboard');
    });
    //Management admin




    //Customer
    Route::get('customer/index', 'UserController@index')->name('customer.index');


    Route::group(['middleware' => ['check_role']], function () {

        // stores
        Route::get('store/index', 'StoreController@index')->name('store.index');
        
        // admins
        Route::get('admin/index', 'AdminController@index')->name('admin.index'); //$url = route('profile', ['id' => 1]);
        Route::post('admin/add', 'AdminController@store')->name('admin.add');
        Route::get('admin/delete/{id}', 'AdminController@delete')->name('admin.delete');
        Route::post('admin/update/{id}', 'AdminController@update')->name('admin.update');
        //Categoríe
        Route::get('category/index', 'CategoryController@index')->name('category.index');
        Route::post('category/add', 'CategoryController@add')->name('category.add');
        Route::post('category/update/{id}', 'CategoryController@update')->name('category.update');
        Route::get('category/delete/{id}', 'CategoryController@delete')->name('category.delete');

        //Products
        Route::get('product/index', 'ProductController@index')->name('product.index');
        Route::post('product/add', 'ProductController@add')->name('product.add');
        Route::post('product/update/{id}', 'ProductController@update')->name('product.update');
        Route::get('product/delete/{id}', 'ProductController@delete')->name('product.delete');
        Route::get('product/viewupdate/{id}', 'ProductController@viewupdate')->name('product.viewupdate');
        Route::get('search-product', 'ProductController@search');
    });
});
