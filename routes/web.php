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

// Example Routes
Route::view('/', 'landing');



Route::group(['prefix' => 'dashboard'], function () {

    Route::get('/','DashboardController@index');

    Route::group(['prefix' => 'users'], function () {
        Route::get('/','UserController@index');
        Route::get('/create','UserController@create');
        Route::post('/create','UserController@store');


        Route::get('/profile','UserController@profile');
        Route::post('/profile/{user}','UserController@profileUpdate');
    });
});



Route::view('/examples/plugin-helper', 'examples.plugin_helper');
Route::view('/examples/plugin-init', 'examples.plugin_init');
Route::view('/examples/blank', 'examples.blank');

Auth::routes();



Route::get('/home', 'HomeController@index')->name('home');
