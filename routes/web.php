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
Route::get('/decrease/{id}', 'ProductController@decrease');
Route::get('/increase/{id}', 'ProductController@increase');
Route::get('/transactions', 'ProductTransactionsController@index');

Route::delete('/delete/{id}', 'ProductController@destroy');

Route::post('/store', 'ProductController@store');
Route::post('/updateIncrease/{id}', 'ProductController@updateIncrease');
Route::post('/updateDecrease/{id}', 'ProductController@updateDecrease');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
