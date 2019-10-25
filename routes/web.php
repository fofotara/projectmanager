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

    Route::group(['prefix' => 'settings'], function () {
        Route::group(['prefix' => 'users'], function () {
            Route::get('/','UserController@index');
            Route::get('/create','UserController@create');
            Route::post('/create','UserController@store');


            Route::get('/profile','UserController@profile');
            Route::post('/profile/{user}/update','UserController@profileUpdate');
        });
        Route::group(['prefix' => 'templates'], function () {
            Route::get('/{template?}','TemplateController@index');
            Route::post('/create','TemplateController@TemplateStore');
            Route::post('updateTemplate','TemplateController@updateTemplate');
            Route::post('TemplateDetailsStore','TemplateController@TemplateDetailsStore');

            Route::get('deleteTemplate/{template}','TemplateController@deleteTemplate');
            Route::get('deleteTemplateDetails/{template}','TemplateController@deleteTemplateDetails');

            Route::post('templateUpdateTitle','TemplateController@templateUpdateTitle');

            Route::get('templateDetailsDelete/{templatedetail}','TemplateController@templateDetailsDelete');
        });


    });

    Route::group(['prefix' => 'projects'], function () {
        Route::get('/','ProjectController@index');
        Route::get('create','ProjectController@create');
    });


});



Route::view('/examples/plugin-helper', 'examples.plugin_helper');
Route::view('/examples/plugin-init', 'examples.plugin_init');
Route::view('/examples/blank', 'examples.blank');

Auth::routes();



Route::get('/home', 'HomeController@index')->name('home');
