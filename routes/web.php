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

Route::get('/', 'ProductController@index');
Route::get('/create', 'ProductController@create');
Route::get('/edit/{id}', 'ProductController@edit');

Route::delete('/delete/{id}', 'ProductController@destroy');

Route::post('/store', 'ProductController@store');
Route::post('/update/{id}', 'ProductController@update');
