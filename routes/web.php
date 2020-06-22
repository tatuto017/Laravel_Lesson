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

// TOPアクセスはフォルダ1にリダイレクトしておく
Route::redirect('/', '/folders/1/tasks');

Route::get('/folders/{id}/tasks', 'TaskController@index')->name('tasks.index');
Route::get('/folders/create'    , 'FolderController@showCreateForm')->name('folders.create');
Route::post('/folders/create'   , 'FolderController@create');
