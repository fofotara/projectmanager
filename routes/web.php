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
Route::get('/kurlar/',function (){
    $kurlar = new \App\Http\Controllers\ExchangeController();
  return  $kurlar->getExchange();
});
Route::get('/data/{project}', 'GanttController@get');

Route::resource('task', 'TaskController');
Route::resource('link', 'LinkController');
Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => 'dashboard'], function () {

        Route::get('/', 'DashboardController@index');

        //AJAX CONTROLLER

        Route::post('getCurrency','Apis\ExchangeController@getCurrency');



        Route::group(['prefix' => 'settings'], function () {
            Route::group(['prefix' => 'invoice'], function () {
                //Invoice Setting
                Route::get('/','SettingController@SettingInvoice');
                Route::post('/save','SettingController@SettingInvoiceSave');
            });
            Route::group(['prefix' => 'users'], function () {
                Route::get('/', 'UserController@index');
                Route::get('/create', 'UserController@create');
                Route::post('/create', 'UserController@store');


                Route::get('/profile', 'UserController@profile');
                Route::post('/profile/{user}/update', 'UserController@profileUpdate');
            });
            Route::group(['prefix' => 'templates'], function () {
                Route::get('/{template?}', 'TemplateController@index');
                Route::post('/create', 'TemplateController@TemplateStore');
                Route::post('updateTemplate', 'TemplateController@updateTemplate');
                Route::post('TemplateDetailsStore', 'TemplateController@TemplateDetailsStore');

                Route::get('deleteTemplate/{template}', 'TemplateController@deleteTemplate');
                Route::get('deleteTemplateDetails/{template}', 'TemplateController@deleteTemplateDetails');

                Route::post('templateUpdateTitle', 'TemplateController@templateUpdateTitle');

                Route::get('templateDetailsDelete/{templatedetail}', 'TemplateController@templateDetailsDelete');
            });

        });


        Route::group(['prefix' => 'invoices'], function () {
            Route::get('/', 'InvoiceController@index');
            Route::get('/create', 'InvoiceController@create');
            Route::any('/saveInvoiceHeader', 'Apis\InvoiceController@saveInvoiceHeader');
            Route::any('/saveInvoiceBody', 'InvoiceController@store');
            Route::get('getCurrentAccount', 'Apis\InvoiceController@getCurrentAccount');

            //DATATABLES
            Route::get('serverside','Apis\InvoiceController@dataTableList')->name('dataTableServerSide');
        });
        Route::group(['prefix' => 'stock'], function () {
            Route::get('/', 'StockController@index');

            //APIS
            Route::get('stocks', 'Apis\StockController@index');
            Route::post('create', 'Apis\StockController@store');
            Route::get('edit/{id}', 'Apis\StockController@edit');
            Route::post('filter', 'Apis\StockController@filter');
            Route::get('getCurrentStock','Apis\StockController@getCurrentStock');
        });

        Route::group(['prefix' => 'current-account'], function () {
            Route::get('/', 'CariController@index');

            //APIS
            Route::get('index', 'Apis\CurrentAccountController@index');
            Route::post('create', 'Apis\CurrentAccountController@store');

        });

        Route::group(['prefix' => 'tax'], function () {
            Route::get('/', 'Apis\TaxController@index');
        });

        Route::group(['prefix' => 'unit'], function () {
            Route::get('/', 'Apis\UnitController@index');
        });

        Route::group(['prefix' => 'projects'], function () {
            Route::get('/', 'ProjectController@index');
            Route::get('create', 'ProjectController@create');
            Route::post('create', 'ProjectController@createOne');
            Route::get('edit/{project}', 'ProjectController@edit');

            Route::get('create-1/{project}', 'ProjectController@projectCreateDetails');
            Route::post('updateProject/{project}','ProjectController@update');

            Route::post('updateProject', 'ProjectController@updateProject');
            Route::post('projectDetailsStore', 'ProjectController@projectDetailsStore');

            Route::get('projectDetailsDelete/{projectdetail}', 'ProjectController@projectDetailsDelete');
            //X_EDITABLE
            Route::post('projectUpdateTitle', 'ProjectController@projectUpdateTitle');
            Route::post('projectUpdateStartDate', 'ProjectController@projectUpdateStartDate');

            //AJAX
            Route::get('projectDetail/{id}', 'ProjectController@projectDetail');
            Route::post('projectDetailUpdate','ProjectDetailController@CreateOrUpdate');


            Route::group(['prefix' => '{projects}'], function ($projects) {
                Route::get('/gant', 'GanttController@index');
                Route::get('main', 'ProjectDetailController@main');
                Route::get('action/{id}', 'ProjectDetailController@action');
            });
        });


    });
});

Route::view('/examples/plugin-helper', 'examples.plugin_helper');
Route::view('/examples/plugin-init', 'examples.plugin_init');
Route::view('/examples/blank', 'examples.blank');

Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');
