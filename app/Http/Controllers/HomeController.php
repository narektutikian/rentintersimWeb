<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Order;
use Rentintersimrepo\orders\ViewHelper;


class HomeController extends Controller
{
    protected $viewHelper;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ViewHelper $viewHelper)
    {
        $this->middleware('auth');
        $this->viewHelper = $viewHelper;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::user()->id;
        $orders = Order::employee($id)->orderby('id', 'desc')->paginate(env('PAGINATE_DEFAULT'));
       $ordersArray = $this->solveOrderList($orders, $this->viewHelper);
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

    public static function solveOrderList($orders, $viewHelper){
    $ordersArray = $orders;
//        dd($orders);
    foreach ($orders as $key => $order) {
        $ordersArray[$key]['created_by'] = $order->creator->login;
        $ordersArray[$key]['updated_by'] = $order->editor->login;
        $ordersArray[$key]['sim_id'] = $order->sim->number;
        if ($ordersArray[$key]['phone_id'] != 0)
            $ordersArray[$key]['phone_id'] = $order->phone->phone;
        $ordersArray[$key]['provider'] = $order->sim->provider->name;
        $ordersArray[$key]['from'] = $viewHelper->present($ordersArray[$key]['from']);
        $ordersArray[$key]['to'] = $viewHelper->present($ordersArray[$key]['to']);

    }
    return $ordersArray;
    }

    public static function getCounts($id){
        $orders = Order::employee($id);
        $counts = ([
            'All' => $orders->count(),
            'active' => $orders->filter('active')->count(),
            'pending' => Order::employee($id)->filter('pending')->count(),
            'waiting' => Order::employee($id)->filter('waiting')->count(),
        ]);
        return $counts;
    }


}
