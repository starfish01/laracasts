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
Route::resource('integrations', 'IntegrationController');

Route::POST('/integrations/{integration}/data', 'IntegrationDataController@store');
Route::get('/integrations/{integration}/data/{integration_data}', 'IntegrationDataController@show');
Route::PATCH('/data/{integration_data}', 'IntegrationDataController@update');
Route::get('/data/{integration_data}/output', 'IntegrationDataController@output');
Route::Delete('/data/{integration_data}/', 'IntegrationDataController@destroy');
