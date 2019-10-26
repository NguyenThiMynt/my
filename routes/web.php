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
Route::group(['prefix' => '/','productype'], function () {
    Route::get('productype/list','ProductypeController@index')->name('productype.index');
    Route::get('productype/search','ProductypeController@index')->name('productype.search');
    Route::get('productype/create', 'ProductypeController@create')->name('productype.create');
    Route::get('productype/edit/{id}', 'ProductypeController@create')->name('productype.edit');
    Route::post('productype/store', 'ProductypeController@store')->name('productype.store');
    Route::get('productype/detail/{id}', 'ProductypeController@show')->name('productype.show');
    Route::put('productype/edit/{id}', 'ProductypeController@update')->name('productype.edit');
    Route::get('productype/delete/{id}', 'ProductypeController@delete')->name('productype.delete');
});

Route::group(['prefix' => '/','products'], function () {
    Route::get('products/list','ProductController@index')->name('product.index');
    Route::get('products/create/{id?}', 'ProductController@create')->name('product.create');
    Route::post('products/store', 'ProductController@store')->name('product.store');
    Route::get('products/detail/{id}', 'ProductController@show')->name('product.show');
    Route::get('products/edit/{id}', 'ProductController@edit')->name('product.edit');
    Route::put('products/edit/{id}', 'ProductController@update')->name('product.edit');
    Route::get('products/delete/{id}', 'ProductController@delete')->name('product.delete');
});

