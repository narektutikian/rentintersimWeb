<?php

namespace App\Http\Controllers\Api;

use App\Http\ViewComposers\NumberComposer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Rentintersimrepo\orders\CreateHelper as Helper;
use Auth;
use App\Http\Controllers\HomeController;
use Rentintersimrepo\orders\ViewHelper;
use Mail;
use App\Mail\OrderMail;
use DB;
use Excel;
use Rentintersimrepo\users\UserManager;
use Carbon\Carbon;
use App\Models\Phone;

class ReportController extends Controller
{
    protected $helper;
    protected $viewHelper;
    protected $userManager;

    public function __construct(Helper $helper, ViewHelper $viewHelper, UserManager $userManager)
    {
        $this->helper = $helper;
        $this->viewHelper = $viewHelper;
        $this->userManager = $userManager;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = Auth::user();

        $orders = null;
        if ($user->level != 'Super admin'){
            $net = $this->userManager->getMyFlatNetwork($user->id);
            $net = $this->userManager->subNetID($net);
            $orders = Order::whereIn('created_by', $net)->orderby('id', 'desc')->paginate(env('PAGINATE_DEFAULT'));
//            dd($orders);
        }
        if ($user->level == 'Super admin')
            $orders = Order::orderby('id', 'desc')->paginate(env('PAGINATE_DEFAULT'));
        $ordersArray = $this->viewHelper->solveOrderList($orders);
        $counts = $this->viewHelper->getCounts($this->userManager);

//        dd($specials);


//        var_dump($ordersArray);
        return view('report', compact('ordersArray'), compact('counts'));


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

        if ($request->input('landing') >= $request->input('departure') ||
            ($request->input('departure') - $request->input('landing')) < 2700 )
            return response()->json(['sim' => 'The landing or departure selection is not correct'], 403);

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
            'landing' =>  $request->input('landing_string'),
            'departure' =>  $request->input('departure_string'),
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
                if ($number != $request->input('phone_id'))
                    return response()->json(['sim' => $number], 403);
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
        $orderSolved = $this->viewHelper->solveOrderList(array($order));


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


//            $Order->from = $this->helper->setStartTime($request->input('landing'));
//            $Order->to =  $this->helper->setEndTime($request->input('departure'));
//            $Order->landing =  $request->input('landing_string');
//            $Order->departure =  $request->input('departure_string');
            $Order->reference_number =  $request->input('reference_number');
//            $Order->costumer_number =  $request->input('costumer_number');
//            $Order->package_id = $request->input('package_id');
            $Order->remark =  $request->input('remark');
            $Order->updated_by =  Auth::user()->id;

/*
            if ($request->has('sim')) {
                $sim = $this->helper->getSim($request->input('sim'));
                if ($sim != null) {
                    if ($sim->number != $request->input('sim')) {
                        if ($sim->state != 'available')
                            return response()->json(['sim' => 'sim is already taken'], 403);
                        $sim->state = 'pending';
                        $sim->save();
                        $Order->sim_id = $sim->id;
                    }
                } else {
                    return response()->json(['sim' => 'sim not found'], 403);
                }
            }
            */
            $Order->save();

            $number = null;
            if ($request->has('phone_id') && $request->input('phone_id') != '' && $request->input('phone_id') != $Order->phone_id) {
                if (Auth::user()->level == 'Super admin') {
                    $number = $this->helper->setNumber($Order->id, $request->input('phone_id'));
                }
            }
            if ($number != null) {
                return $this->edit($Order->id);
            }

            return response($Order->toArray(), 200);


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
        if ($Order != null){
            if ($Order->status != 'active'){
//                $this->helper->deactivate($id);
                $this->helper->freeResources($Order, 'deleted');
                return response()->json(['deleted'], 200);
            }
            return response()->json(['not allowed'], 403);
        }
    }

    public function filter($filter){
        $user = Auth::user();
        $orders = null;
        if ($user->level != 'Super admin'){
            $net = $this->userManager->subNetID($this->userManager->getMyFlatNetwork($user->id));
            $orders = Order::whereIn('created_by', $net)->filter($filter)->orderby('id', 'desc')->paginate(env('PAGINATE_DEFAULT'));
        }
        if ($user->level == 'Super admin')
            $orders = Order::filter($filter)->orderby('id', 'desc')->paginate(env('PAGINATE_DEFAULT'));
        $ordersArray = $this->viewHelper->solveOrderList($orders);
        $counts = $this->viewHelper->getCounts($this->userManager);

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

    public function getNumberExternal($orderid)
    {   $number = null;
        $order = Order::find($orderid);
        if($order->exists){
            if ($order->phone_id == 0)
                $number = $this->helper->getNumber($order);
            else return $order->phone_id;
        }
        if ($number != null) {

            return response()->json(['number' => $order->phone->phone], 200);
        }
        else

        return response()->json(['number' => 'not found'], 403);

    }

    public function activate()
    {
        $this->helper->startActivation();
    }

    public function deactivate()
    {
        $this->helper->startDeactivation();
    }

    public function sendMail($orderID, Request $request)
    {
        $this->validate(request(), [
        'email' => 'required|email'
        ]);

        $data = array(
           'order' => $orderID,
            'text' => $request->input('remark')
        );

        Mail::to($request->input('email'))->queue(new OrderMail($data));


    }

    public function search(Request $request)
    {
        $query = stripcslashes($request->input('query'));
        $net = $this->userManager->subNetID($this->userManager->getMyFlatNetwork(Auth::user()->id));

        $result = Order::withTrashed()->where('status', '!=', 'deleted')->where(function ($q) use ($query) {
            $q->whereIn('phone_id', function ($q) use ($query) {
                $q->select('id')->from('phones')->
                where('phone', 'LIKE', '%' . $query . '%');
            })
                ->orWhereIn('sim_id', function ($q) use ($query) {
                $q->select('id')->from('sims')->where('number', 'LIKE', '%' . $query . '%');
            })
                ->orWhere('reference_number', 'LIKE', '%' . $query . '%');
        })
            ->whereIn('created_by', $net)
            ->paginate(env('PAGINATE_DEFAULT'));

        $ordersArray = $this->viewHelper->solveOrderList($result);
//        $counts = $this->viewHelper->getCounts($this->userManager);

        return view('report', compact('ordersArray')
//            , compact('counts')
        );
    }

    public function export()
    {
        $user = Auth::user();
        $orders = null;
        if ($user->level != 'Super admin'){
            $net = $this->userManager->subNetID($this->userManager->getMyFlatNetwork(Auth::user()->id));
            $orders = Order::whereIn('created_by', $net)->orderby('id', 'desc')->get();
        }
        if ($user->level == 'Super admin')
            $orders = Order::get();
        $ordersArray = $this->viewHelper->solveOrderList($orders);

        Excel::create('Orders', function($excel) use ($ordersArray) {

            $excel->sheet('orders', function($sheet) use($ordersArray) {

                $sheet->fromArray($ordersArray);

            });

        })->download('xlsx');
    }

    public function generateReport(Request $request)
    {
        $net = $this->userManager->subNetID($this->userManager->getMyFlatNetwork(Auth::user()->id));
        if (!$request->has('provider'))
            $report = Order::where('id', '<', 0);
        else {
            $report = Order::withTrashed()->where('status', 'suspended')->whereIn('created_by', $net);
            if ($request->has('username'))
                $report = $report->where('created_by', $request->input('username'));
            if ($request->has('from')){
                $from = Carbon::createFromFormat('d/m/Y', $request->input('from'));
                $report = $report->where('from', '>', $from->timestamp);
            }
            if ($request->has('to')){
                $from = Carbon::createFromFormat('d/m/Y', $request->input('to'));
                $report = $report->where('to', '<', $from->timestamp);
            }
            if ($request->has('number')){
                $number = Phone::where('phone', $request->input('number'))->first()->id;
//                dd($number);
                if ($number != null)
                $report = $report->where('phone_id', $number);
            }

        }





            if ($request->has('export')){
            $report = $report->get();
            $ordersArray = $this->viewHelper->solveOrderList($report);
            Excel::create('Report', function($excel) use ($ordersArray) {

                $excel->sheet('report', function($sheet) use($ordersArray) {

                    $sheet->fromArray($ordersArray);

                });

            })->download('xlsx');
            }

            else { $report = $report->paginate(env('PAGINATE_DEFAULT')); }

            $ordersArray = $this->viewHelper->solveOrderList($report);
            $ordersArray->setPath("report?provider=".$request->input('provider').
                "&level=".$request->input('level').
                "&from=".$request->input('from').
                "&username=".$request->input('username').
                "&to=".$request->input('to').
                "&number=".$request->input('number'));
            return view('report', compact('ordersArray'));


    }


}
