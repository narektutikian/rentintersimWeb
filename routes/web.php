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
use App\Models\Activation;

Route::get('/', function () {
    return view('errors.503');
});

Auth::routes();


Route::get('/dashboard', 'HomeController@dashboard');

Route::group(['namespace' => 'Api', 'middleware'=> 'auth'], function () {

//    Super admin
    /*****Activate - Deactivate******/
    Route::get('activate/{id}', 'OrderController@activate');
    Route::get('deactivate/{id}', 'OrderController@deactivate');

    /*****Auth Routes******/
    Route::get('imitate', 'UserController@showImitation');
    Route::post('imitate', 'UserController@imitate');

//    Super admin end
    Route::get('/home', 'OrderController@index');

    /* Resource Routes */
    Route::resource('user', 'UserController');
    Route::resource('order', 'OrderController');
    Route::resource('number', 'PhoneController');
    Route::resource('sim', 'SIMController');
    Route::resource('type', 'PackageController');
//    Route::resource('report', 'ReportController');

    /*****Get new Number******/
    Route::get('get-number/{orderId}', 'OrderController@getNumberExternal');

    /*Filter Routes*/
    Route::get('filter-orderlist/{filter}', 'OrderController@filter');
    Route::get('filter-numberlist/{filter}', 'PhoneController@filter');
    Route::get('filter-simlist/{filter}', 'SIMController@filter');
    Route::get('filter-packagelist/{filter}', 'PackageController@filter');

    /***Ajax requests***/
    Route::get('user-tree', 'UserController@getUserTree');
    Route::get('user-flat-tree', 'UserController@getFlatTree');
    Route::get('user-id-tree', 'UserController@getIdTree');
    Route::get('user-by-level/{level}', 'UserController@getByLevel');
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
    Route::get('search/report', 'ReportController@search');

    Route::get('send-mail/{orderID}', 'OrderController@sendMail');

    Route::get('report', 'ReportController@generateReport');
    Route::get('phone/specials/{packageID}', 'PhoneController@specials');

    /**** Recover Routes ****/
    Route::post('sim/recover/{id}', 'SIMController@recover');
    Route::post('number/recover/{id}', 'PhoneController@recover');

    Route::get('/api/order', 'OrderController@orderTable');
});




Route::get('/test', function (){
echo Order::where('phone_id', 11)->where('status', 'pending')->count();
});

Route::get('/test2', function (){
    $orders = Order::where('status', 'pending')->orWhere('status', 'waiting')->orderBy('from', 'asc')->get();
    foreach ($orders as $order){
        $date = Carbon::createFromFormat('d/m/Y H:i', $order->landing)->subHours(1);
        if ($date->hour >= 2 && $date->hour <= 6){
            $date->setTime(1,0);
        }
//        $order->from = $date->timestamp;
//        $order->save();
        echo "id: ".$order->id." | activation time: ". Carbon::createFromTimestamp($order->from)->format('d/m/Y H:i'). " |  user chois: ". $order->landing ." | Status: " . $order->status. "<br>";
    }

});


