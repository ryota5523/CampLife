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


Auth::routes();

Route::get('/', 'PostController@index')->name('index');
Route::get('show/{id}', 'PostController@show')->name('show');
Route::get('/{id}', 'UserController@index')->name('users');

Route::group(['prefix' => 'users', 'middleware' => 'auth'], function(){
  Route::get('/edit/{id}', 'UserController@edit')->name('edit');
  Route::post('/update/{id}', 'UserController@update')->name('update');
});

Route::group(['prefix' => 'post', 'middleware' => 'auth'], function(){
  Route::get('create', 'PostController@create')->name('create');
  Route::post('store', 'PostController@store')->name('store');
  Route::get('edit/{id}', 'PostController@edit')->name('edit');
  Route::post('update/{id}', 'PostController@update')->name('update');
  Route::post('destroy/{id}', 'PostController@destroy')->name('destroy');
});
