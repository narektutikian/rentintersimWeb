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
        $orders = Order::get();
        $ordersArray = $orders->toArray();
        foreach ($orders as $key => $order) {
            $ordersArray[$key]['created_by'] = $order->creator->login;
            $ordersArray[$key]['edited_by'] = $order->editor->login;
            $ordersArray[$key]['sim_id'] = $order->sim->number;
            if ($ordersArray[$key]['phone_id'] != 0)
            $ordersArray[$key]['phone_id'] = $order->phone->phone;
            $ordersArray[$key]['provider'] = $order->sim->provider->name;

        }
        return view('home', compact('ordersArray'));

    }

    public function dashboard()
    {
        if (Auth::user()->type == 'employee')
            return redirect('home');
        return view('dashboard');
    }
}
