<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Order;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::user()->id;
        $orders = Order::employee($id)->get();
       $ordersArray = $this->solveOrderList($orders);
        $counts = $this->getCounts($id);


//        var_dump($ordersArray);
        return view('home', compact('ordersArray'), compact('counts'));

    }

    public function dashboard()
    {
        if (Auth::user()->type == 'employee')
            return redirect('home');
        return view('dashboard');
    }

    public static function solveOrderList($orders){
    $ordersArray = $orders->toArray();
    foreach ($orders as $key => $order) {
        $ordersArray[$key]['created_by'] = $order->creator->login;
        $ordersArray[$key]['updated_by'] = $order->editor->login;
        $ordersArray[$key]['sim_id'] = $order->sim->number;
        if ($ordersArray[$key]['phone_id'] != 0)
            $ordersArray[$key]['phone_id'] = $order->phone->phone;
        $ordersArray[$key]['provider'] = $order->sim->provider->name;
    }
    return $ordersArray;
    }

    public static function getCounts($id){
        $orders = Order::employee($id);
        $counts = ([
            'All' => $orders->count(),
            'Active' => $orders->filter('Active')->count(),
            'Pending' => Order::employee($id)->filter('Pending')->count(),
            'Waiting' => Order::employee($id)->filter('Waiting')->count(),
        ]);
        return $counts;
    }
}
