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


Route::get('admin', array('uses' => 'Admin@index'));

Route::post('admin', array('uses' => 'Admin@doLogin'));

Route::get('admin/logout', array('uses' => 'Admin@doLogout'));

Route::resource('admin/resources', 'ResourceController');
