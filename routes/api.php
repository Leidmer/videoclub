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

Route::get('v1/catalog', 'APICatalogController@index');

Route::get('v1/catalog/{id}', 'APICatalogController@show');

Route::post('v1/catalog', 'APICatalogController@store')->middleware('auth.basic.once');

Route::put('v1/catalog/{id}', 'APICatalogController@update')->middleware('auth.basic.once');

Route::delete('v1/catalog/{id}', 'APICatalogController@destroy')->middleware('auth.basic.once');

Route::put('v1/catalog/{id}/rent', 'APICatalogController@putRent')->middleware('auth.basic.once');

Route::put('v1/catalog/{id}/return', 'APICatalogController@putReturn')->middleware('auth.basic.once');
