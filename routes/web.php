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

Route::get('/', ['as' => 'products.index', 'uses' => 'ProductsController@index']);
Route::get('edit-product/{id}', ['as' => 'products.edit', 'uses' => 'ProductsController@edit']);
Route::get('create-product', ['as' => 'products.create', 'uses' => 'ProductsController@create']);
Route::post('create-product', 'ProductsController@store');
Route::post('edit-product/{id}', 'ProductsController@update');
Route::delete('edit-product/{id}', 'ProductsController@delete');

Route::post('export-products', 'ProductsController@export');
Route::get('get-xls/{id}', 'ProductsController@getXls');