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

Route::get('/home', 'HomeController@index');
Route::get('/dashboard', 'HomeController@dashboard');

Route::group(['namespace' => 'Api', 'middleware'=> 'auth'], function () {
    /* Resource Routes */
    Route::resource('user', 'UserController');
    Route::resource('order', 'OrderController');
    Route::resource('phone', 'PhoneController');


    /*Auth Routes*/
    Route::get('imitate', 'UserController@showImitation');
    Route::post('imitate', 'UserController@imitate');

    /*Filter Routes*/
    Route::get('filter-orderlist/{filter}', 'OrderController@filter');
    Route::get('filter-phonelist/{filter}', 'PhoneController@filter');
});

Route::get('/test', function (){
/*
    print_r(Order::where
    ([
        ['is_deleted', '!=', 0],
        ['status', '=', 'Active'],
        ['created_by', 30]
    ])
        ->orWhere('updated_by', 30)->get());*/
//$order = Order::where([['created_by', '20'],['status', 'Waiting']])->orWhere([['updated_by', '20'],['status', 'Waiting']])->get()->toArray();
//
    $order = Order::employee(20)->filter('Waiting')->get()->toArray();
    dd($order);
});

