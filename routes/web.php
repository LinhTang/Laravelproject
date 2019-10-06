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

Route::group(['company', 'middleware' => ['auth','company' ]],function(){
    Route::get('/company/{name}', 'companyController@index');
    Route::get('/company', 'companyController@index');
    Route::get('/company/{any?}', 'companyController@index')->where('any','.*');
});

Route::group(['company', 'middleware' => ['auth','company' ]],function(){
    Route::get('/order/{name}', 'orderController@index');
});

Route::group(['admin', 'middleware' => ['auth','admin']],function(){
    Route::get('/admin', 'adminController@index');
    Route::get('/admin/{name}', 'adminController@index');
    Route::get('/admin/{any?}', 'adminController@index')->where('any','.*');
});

Route::any('/admin/{any?}', 'adminController@index')->where('any','.*')->middleware('auth');
Route::any('/company/{any?}', 'companyController@index')->where('any','.*')->middleware('auth');

Route::post('/chat','ChatController@sendMessage');
Route::get('/chat','ChatController@chatPage');

