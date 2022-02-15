<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['namespace' => 'App\Http\Controllers'],function(){
    // for task
    Route::get('/','TaskController@index');
    Route::post('/create-task','TaskController@create')->name('create.task');
    Route::get('/task/edit{id}','TaskController@edit');
    Route::post('/task/update', 'TaskController@update')->name('task.update');
    Route::get('/delete/task{id}','TaskController@Destroy')->name('task.delete');
    Route::post('/filter','TaskController@filter')->name('task.filter');

// for Type
    Route::get('/type','TypeController@index')->name('type.index');
  
    Route::post('/type/add-type','TypeController@create')->name('add.type');
    Route::get('/type/edit{id}','TypeController@edit');
    Route::get('/type/delete{id}','TypeController@Destroy')->name('type.delete');
    Route::post('/type/update', 'TypeController@update')->name('type.update');
    

});
