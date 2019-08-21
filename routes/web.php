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

Route::get('/', 'PagesController@index');

Route::resource('category', 'CategoryController');


//Tables
Route::get('/table', 'TableController@index');
Route::post('/table', 'TableController@store');
Route::get('/table/create', 'TableController@create');
Route::get('/table/{tableId}/show', 'TableController@show');
Route::get('/table/{tableId}/edit', 'TableController@edit');
Route::put('/table/{tableId}', 'TableController@update');
Route::delete('/table/{tableId}', 'TableController@delete');

//Finances
Route::get('/table/{tableId}', 'FinanceController@index');
Route::post('/finance', 'FinanceController@store');
Route::get('/table/{tableId}/create', 'FinanceController@create');
Route::get('/table/{tableId}/item/{itemId}', 'FinanceController@show');
Route::get('/table/{tableId}/item/{itemId}/edit', 'FinanceController@edit');
Route::put('/table/{tableId}/item/{itemId}', 'FinanceController@update');
Route::delete('/table/{tableId}/item/{itemId}', 'FinanceController@delete');

//Persons
Route::get('/table/{tableId}/persons', 'PersonController@index');
Route::post('/person', 'PersonController@store');
Route::get('/table/{tableId}/person/create', 'PersonController@create');
Route::get('/table/{tableId}/person/{personId}', 'PersonController@show');
Route::get('/table/{tableId}/person/{personId}/edit', 'PersonController@edit');
Route::put('/table/{tableId}/person/{personId}', 'PersonController@update');
Route::delete('/table/{tableId}/person/{personId}', 'PersonController@delete');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin', 'AdminController@admin')->middleware('is_admin')->name('admin');
