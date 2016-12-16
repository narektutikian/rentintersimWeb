<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Rentintersimrepo\orders\CreateHelper as Helper;
use Auth;
use App\Http\Controllers\HomeController;
use Rentintersimrepo\orders\ViewHelper;
use Mail;
use App\Mail\OrderMail;

class OrderController extends Controller
{
    protected $helper;
    protected $viewHelper;

    public function __construct(Helper $helper, ViewHelper $viewHelper)
    {
        $this->helper = $helper;
        $this->viewHelper = $viewHelper;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('ordercreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $number = null;

        $status ='waiting';
        $this->validate(request(), [
//        'from' => 'required',
//        'to' =>  'required',
        'sim' => 'required',
        'landing' =>  'required',
        'departure' =>  'required',
            'package_id' => 'required'
//        'reference_number' =>  'required',
//        'status' =>  'required',
//        'remark' =>  'required',
//        'costomer_id' =>  'required',
//        'employee_id' =>  'required',
//        'created_by' =>  'required',
//        'updated_by' =>  'required',

        ]);

            $sim = $this->helper->getSim($request->input('sim'));
        if($sim != null){
            if ($sim->state != 'available')
            return response()->json(['sim'=>'sim is already taken'], 403);
        $sim->state = 'pending';
        $sim->save();
        } else {return response()->json(['sim' => 'sim not found'], 403);}
//                dd($simId);

        $newOrder = Order::forceCreate([
            'from' => $this->helper->setStartTime($request->input('landing')),
            'to' =>  $this->helper->setEndTime($request->input('departure')),
            'landing' =>  $request->input('landing'),
            'departure' =>  $request->input('departure'),
            'reference_number' =>  $request->input('reference_number'),
            'status' =>  $status,
            'costumer_number' =>  $request->input('costumer_number'),
            'package_id' => $request->input('package_id'),
            'remark' =>  $request->input('remark'),
            'created_by' =>  Auth::user()->id,
            'updated_by' =>  Auth::user()->id,
            'sim_id' => $sim->id,
            'phone_id' => 0,

        ]);

        if($request->has('phone_id') && $request->input('phone_id') != ''){
            if (Auth::user()->level == 'Super admin'){
                $number = $this->helper->setNumber($newOrder->id, $request->input('phone_id'));
            }
            } else {
            $number = $this->getNumber($newOrder->id);
            }
            if ($number != null){
                return $this->edit($newOrder->id);
              }

        return response($newOrder->toArray(), 200);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $order = Order::find($id);
//        dd($order);
        $orderSolved = HomeController::solveOrderList(array($order), $this->viewHelper);


        return response()->json($orderSolved, 200);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate(request(), [
//        'from' => 'required',
//        'to' =>  'required',
//            'sim_id' => 'required',
//            'landing' =>  'required',
//            'departure' =>  'required',
//            'package_id' => 'required'
//        'reference_number' =>  'required',
//        'status' =>  'required',
//        'remark' =>  'required',
//        'costomer_id' =>  'required',
//        'employee_id' =>  'required',
//        'created_by' =>  'required',
//        'updated_by' =>  'required',

        ]);

        $Order = Order::find($id);


            $Order->from = $this->helper->setStartTime($request->input('lending'));
            $Order->to =  $this->helper->setEndTime($request->input('departure'));
            $Order->landing =  $request->input('lending');
            $Order->departure =  $request->input('departure');
            $Order->reference_number =  $request->input('package_id');
            $Order->costumer_number =  $request->input('costumer_number');
            $Order->package_id = $request->input('package_id');
            $Order->remark =  $request->input('remark');
            $Order->updated_by =  Auth::user()->id;
            if ($request->has('sim_id')){
                $Order->sim_id = $request->input('sim_id');
                $Order->status =  'waiting';
            }
            $Order->save();



            return $Order;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $Order = Order::find($id);


    }

    public function filter($filter){
        $user = Auth::user();
        $orders = null;
        if ($user->level != 'Super admin')
        $orders = Order::employee($user->id)->filter($filter)->orderby('id', 'desc')->paginate(env('PAGINATE_DEFAULT'));
        if ($user->level == 'Super admin')
            $orders = Order::filter($filter)->orderby('id', 'desc')->paginate(env('PAGINATE_DEFAULT'));
        $ordersArray = HomeController::solveOrderList($orders, $this->viewHelper);
        $counts = HomeController::getCounts($user->id);

        return view('home', compact('ordersArray'), compact('counts'));
    }

    public function getNumber($orderid)
    {   $number = null;
        $order = Order::find($orderid);
        if($order->exists){
            if ($order->phone_id == 0)
        $number = $this->helper->getNumber($order);
        else return $order->phone_id;
        }

        return $number;
    }

    public function activate()
    {
        $this->helper->startActivation();
    }

    public function deactivate()
    {
        $this->helper->startDeactivation();
    }

    public function sendMail(Request $request)
    {
        Mail::to('narek@horizondvp.com')->send(new OrderMail);

        return redirect('home');
    }
}
