<?php

namespace App\Http\Controllers;

use App\Models\Phone;
use Illuminate\Http\Request;
use Auth;
use App\Models\Order;
use Rentintersimrepo\orders\ViewHelper;
use Rentintersimrepo\users\UserManager;


class HomeController extends Controller
{
    protected $viewHelper;
    protected $userManager;

    /**
     * Create a new controller instance.
     * @param Rentintersimrepo\users\UserManager
     * @param Rentintersimrepo\users\UserManager
     * @return void
     */
    public function __construct(ViewHelper $viewHelper, UserManager $userManager)
    {
        $this->middleware('auth');
        $this->viewHelper = $viewHelper;
        $this->userManager = $userManager;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      /*  $user = Auth::user();

        $orders = null;
        if ($user->level != 'Super admin'){
            $net = $this->userManager->getMyFlatNetwork($user->id);
            $net = $this->userManager->subNetID($net);
            $orders = Order::whereIn('created_by', $net)->orderby('id', 'desc')->paginate(env('PAGINATE_DEFAULT'));
        }
        if ($user->level == 'Super admin')
            $orders = Order::orderby('id', 'desc')->paginate(env('PAGINATE_DEFAULT'));
       $ordersArray = $this->solveOrderList($orders, $this->viewHelper);
        $counts = $this->getCounts($user->id, $this->userManager);

//        dd($specials);


//        var_dump($ordersArray);
        return view('home', compact('ordersArray'), compact('counts'));*/

    }

    public function dashboard()
    {
        if (Auth::user()->type == 'employee')
            return redirect('home');
        if (Auth::user()->level != 'Super admin')
            return redirect('user');
        if (Auth::user()->level == 'Super admin')
            return view('dashboard');
        return redirect('home');
    }

 /*   public static function solveOrderList($orders, $viewHelper){
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
//        $ordersArray[$key]['package_id'] = $order->package->name;
        $ordersArray[$key]['package_name'] = $order->package->name;
//        $ordersArray[$key]['landing'] = $viewHelper->present($ordersArray[$key]['landing']);
//        $ordersArray[$key]['departure'] = $viewHelper->present($ordersArray[$key]['departure']);

        unset($ordersArray[$key]['costumer_number']);
        unset($ordersArray[$key]['deleted_at']);

    }
    return $ordersArray;
    }*/

    /*public static function getCounts($id, $userManager){
        $orders = null;
        $user = Auth::user();
        if ($user->level != 'Super admin'){
            $net = $userManager->getMyFlatNetwork($user->id);
            $net = $userManager->subNetID($net);
            $orders = Order::whereIn('created_by', $net);
        }
        if ($user->level == 'Super admin')
        $orders = Order::where('deleted_at', null);
        $ordersp = clone($orders);
        $ordersw = clone($orders);
//        dd($orders);
        $counts = ([
            'All' => $orders->count(),
            'active' => $orders->filter('active')->count(),
            'pending' => $ordersp->filter('pending')->count(),
            'waiting' => $ordersw->filter('waiting')->count(),
        ]);
//        dd($counts);
        return $counts;
    }*/


}
