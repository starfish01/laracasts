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

/*

    GET /projects (index)
    GET /projects/create (create)
    GET /projects/1 (show)
    POST /projects (store)
    GET /projects/1/edit (edit)
    PATCH /projects/1 (update)
    GET /projects/1 (delete)

*/

Route::resource('projects', 'ProjectsController');

Route::patch('/tasks/{task}', 'ProjectTasksController@update');
Route::POST('/projects/{project}/tasks', 'ProjectTasksController@store');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
