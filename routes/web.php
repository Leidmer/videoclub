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

Route::get('/', 'HomeController@getHome');

Route::get('catalog', 'CatalogController@getIndex')->middleware('auth');
Route::get('/catalog/show/{id}', 'CatalogController@getShow')->middleware('auth');

Route::get('/catalog/create', 'CatalogController@getCreate')->middleware('auth');
Route::post('/catalog/create', 'CatalogController@postCreate')->middleware('auth');

Route::get('catalog/edit/{id}', 'CatalogController@getEdit')->middleware('auth');
Route::put('catalog/edit/{id}', 'CatalogController@putEdit')->middleware('auth');


Route::put('catalog/rent/{id}', 'CatalogController@putRent')->middleware('auth');
Route::put('catalog/return/{id}', 'CatalogController@putReturn')->middleware('auth');
Route::delete('catalog/delete/{id}', 'CatalogController@deleteMovie')->middleware('auth');

Route::post('/review/create/{id}', 'CatalogController@postReview')->middleware('auth');
Route::get('/catalog','CatalogController@searchMovie')->middleware('auth');
Route::get('/catalog/show','CatalogController@showRating')->middleware('auth');;
Route::resource('category','CategoryController');
Route::get('/addimage','ImageController@imageIndex');
Route::post('/addimage','ImageController@imageStore')->name('addimage');
Auth::routes();
Route::get('/home', 'HomeController@index')->middleware('auth');;
