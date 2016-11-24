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
//use Auth;

Route::get('/', function () {
    return view('welcome');
})->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/dashboard', 'HomeController@dashboard');

Route::group(['namespace' => 'Api', 'middleware'=> 'auth'], function () {
    Route::resource('user', 'UserController');

    Route::get('imitate', 'UserController@showImitation');


    Route::post('imitate', 'UserController@imitate');

});

Route::get('/test', function (){
    $net = User::select('id', 'login')->where('id', '!=', Auth::user()->id)->get()->toArray();
    return view('auth.imitate', compact('net'));
});

