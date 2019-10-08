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

//Tables
Route::get('/table', 'tableController@index');
Route::post('/table', 'tableController@store');
Route::get('/table/create', 'tableController@create');
Route::get('/table/{tableId}/show', 'tableController@show');
Route::get('/table/{tableId}/edit', 'tableController@edit');
Route::put('/table/{tableId}', 'tableController@update');
Route::delete('/table/{tableId}', 'tableController@delete');

//Finances
Route::get('/table/{tableId}', 'itemController@index');
Route::post('/finance', 'itemController@store');
Route::get('/table/{tableId}/create', 'itemController@create');
Route::get('/table/{tableId}/item/{itemId}', 'itemController@show');
Route::get('/table/{tableId}/item/{itemId}/edit', 'itemController@edit');
Route::put('/table/{tableId}/item/{itemId}', 'itemController@update');
Route::delete('/table/{tableId}/item/{itemId}', 'itemController@delete');

//Persons
Route::get('/table/{tableId}/persons', 'personController@index');
Route::post('/person', 'personController@store');
Route::get('/table/{tableId}/person/create', 'personController@create');
Route::get('/table/{tableId}/person/{personId}', 'personController@show');
Route::get('/table/{tableId}/person/{personId}/edit', 'personController@edit');
Route::put('/table/{tableId}/person/{personId}', 'personController@update');
Route::delete('/table/{tableId}/person/{personId}', 'personController@delete');
