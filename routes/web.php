<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

use App\User;
use App\Models\Order;

//use Auth;
use Carbon\Carbon;

Route::get('/', function () {
    return redirect('home');
})->middleware('auth');

Auth::routes();

Route::get('/home', 'Api\OrderController@index');
Route::get('/dashboard', 'HomeController@dashboard');

Route::group(['namespace' => 'Api', 'middleware'=> 'auth'], function () {
    /* Resource Routes */
    Route::resource('user', 'UserController');
    Route::resource('order', 'OrderController');
    Route::resource('number', 'PhoneController');
    Route::resource('sim', 'SIMController');
    Route::resource('type', 'PackageController');

    /*****Get new Number******/
    Route::get('get-number/{orderId}', 'OrderController@getNumberExternal');

    /*****Activate - Deactivate******/
    Route::get('activate', 'OrderController@activate');
    Route::get('deactivate', 'OrderController@deactivate');

    /*****Auth Routes******/
    Route::get('imitate', 'UserController@showImitation');
    Route::post('imitate', 'UserController@imitate');

    /*Filter Routes*/
    Route::get('filter-orderlist/{filter}', 'OrderController@filter');
    Route::get('filter-numberlist/{filter}', 'PhoneController@filter');
    Route::get('filter-simlist/{filter}', 'SIMController@filter');
    Route::get('filter-packagelist/{filter}', 'PackageController@filter');

    /***Ajax requests***/
    Route::get('user-tree', 'UserController@getUserTree');
    Route::get('user-flat-tree', 'UserController@getFlatTree');
    Route::get('user-id-tree', 'UserController@getIdTree');
    Route::get('type-provider/{providerId}', 'PackageController@typeofProvider');

    /******Export Import routes******/
    Route::get('exportsims', 'SIMController@export');
    Route::post('import-sim', 'SIMController@import');
    Route::get('exporttypes', 'PackageController@export');
    Route::post('import-type', 'PackageController@import');
    Route::get('exportnumber', 'PhoneController@export');
    Route::post('import-number', 'PhoneController@import');
    Route::get('exportorders', 'OrderController@export');

    /******Search  routes******/
    Route::get('search/sim', 'SIMController@search');
    Route::get('search/type', 'PackageController@search');
    Route::get('search/number', 'PhoneController@search');
    Route::get('search/order', 'OrderController@search');

    Route::get('send-mail/{orderID}', 'OrderController@sendMail');
});


Route::get('/test', function (){

    return view('mail.notify')->with('order', Order::find(245))->with('text', 'text');
});


