<?php

namespace App\Http\Controllers\Api;

use App\Http\ViewComposers\NumberComposer;
use App\Models\Report;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Rentintersimrepo\orders\CreateHelper as Helper;
use Auth;
use App\Http\Controllers\HomeController;
use Rentintersimrepo\orders\ViewHelper;
use Rentintersimrepo\report\ReportHelper;
use Mail;
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
    protected $reportHelper;

    public function __construct(Helper $helper, ViewHelper $viewHelper, UserManager $userManager, ReportHelper $reportHelper)
    {
        $this->helper = $helper;
        $this->viewHelper = $viewHelper;
        $this->userManager = $userManager;
        $this->reportHelper = $reportHelper;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('report');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('financial-report');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

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
        $report = null;
        $orders = Order::withTrashed()->whereIn('status', ['active', 'done'])->get();
        foreach ($orders as $order) {

        if ($order != null)
                $report = Report::where('order_id', $order->id)->first();
                if ($report == null){
                    $report = $this->reportHelper->calculateReport($order);
                    $report->save();
                }
            }
        return response($report);


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
        $this->reportHelper->calculateFinalReport($order);
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
    }

    public function generateReport(Request $request)
    {
        $total = 1;
        $q = $request->all();
        $fromS = '2017/01/01';
        $toS = '0000/00/00';
        $net = $this->userManager->getNetworkFromCache(Auth::user()->id);
        if (!$request->has('provider'))
            $report = Order::where('id', '<', 0);
        else {
            $report = Order::withTrashed()->where(function ($q){
                $q->where('orders.status', 'done')->orWhere('orders.status', 'active');
            })->whereIn('created_by', $net);
            if ($request->has('username')){
                $userID = $request->input('username');
                $net = $this->userManager->getNetworkFromCache($userID);
                $report = $report->whereIn('created_by', $net);
            }
            if ($request->has('from')){
                $from = Carbon::createFromFormat('d/m/Y', $request->input('from'))->setTime(0,0,0)->subHour();
                $report = $report->where('from', '>', $from->timestamp);
                $fromS = $request->input('from');
            }
            if ($request->has('to')){
                $to = Carbon::createFromFormat('d/m/Y', $request->input('to'))->setTime(23,59,59);
                $report = $report->where('from', '<', $to->timestamp);
                $toS = $request->input('to');
            }
            if ($request->has('number')){
                $number = Phone::withTrashed()->where('phone', $request->input('number'))->first();
//                dd($number->id);
                if ($number != null)
                $report = $report->where('phone_id', $number->id);
            }

        }

        if ($request->has('sort')){
            if ($q['sort'] == 'phone.phone'){
                $report = $report->join('phones', 'orders.phone_id', '=', 'phones.id')
                    ->select('orders.*', 'phones.phone')
                    ->orderBy('phone', $request->input('order'));

            }
            elseif ($q['sort'] == 'sim.number'){
                $report = $report->join('sims', 'orders.sim_id', '=', 'sims.id')
                    ->select('orders.*', 'sims.number')
                    ->orderBy('number', $request->input('order'));

            }
            elseif ($q['sort'] == 'landing'){
                $report = $report->orderBy('from', $q['order']);
            }
            elseif ($q['sort'] == 'departure'){
                $report = $report->orderBy('to', $q['order']);
            }
            elseif ($q['sort'] == 'creator.login'){
                $report = $report->join('users', 'orders.created_by', '=', 'users.id')
                    ->select('orders.*', 'users.login')
                    ->orderBy('login', $request->input('order'));
            }
            elseif ($q['sort'] == 'status'){
                $report = $report->orderBy('status', $q['order']);
            }
            elseif ($q['sort'] == 'package.name'){
                $report = $report->join('packages', 'orders.package_id', '=', 'packages.id')
                    ->select('orders.*', 'packages.name')
                    ->orderBy('packages.name', $request->input('order'));
            }
//            $report = $report->with(['phone', 'sim', 'creator', 'sim.provider']);


        }
        else {
            $report = $report->orderBy('id', 'desc');
        }

        if ($request->has('search')){

            $qs = $request->input('search');
            $report = $report->where(function ($q) use ($qs) {
                $q->orWhereIn('orders.phone_id', function ($q) use ($qs) {
                    $q->select('id')->from('phones')->
                    where('phone', 'LIKE', '%' . $qs . '%');
                })
                    ->orWhereIn('sim_id', function ($q) use ($qs) {
                        $q->select('sims.id')->from('sims')->where('number', 'LIKE', '%' . $qs . '%');
                    })
                    ->orWhere('reference_number', 'LIKE', '%' . $qs . '%');
            });
        }

        $report = $report->with(['phone'  => function ($q){
            $q->withTrashed();
        }, 'sim'  => function ($q){
            $q->withTrashed();
        }, 'creator'  => function ($q){
            $q->withTrashed();
        }, 'package', 'report', 'sim.provider']);

/*            if ($request->has('export')){
            $report = $report->get();
            $ordersArray = $this->viewHelper->solveOrderList($report);
            $ordersArray = $this->viewHelper->prepareExport($ordersArray, 'report');
            Excel::create('Report from-'.$fromS. '&to-'.$toS , function($excel) use ($ordersArray) {

                $excel->sheet('report', function($sheet) use($ordersArray) {

                    $sheet->fromArray($ordersArray);

                });

            })->download('xlsx');
            }*/
            if ($request->has('export')){
                if($request->input('page') == 'financial')
                    $this->exportFinancialReport($report)->download('xlsx');
                else
                    $this->exportBasicReport($report)->download('xlsx');

            }

            else {
                $total = clone $report;
                $total = $total->count();
                $report = $report->take($q['limit'])->skip($q['offset'])->get();
            }


            foreach ($report as $item){
               $item->duration = $this->viewHelper->calculateInterval($item->landing, $item->departure). ' day(s)';
            }
//            echo '<pre>';
//            var_dump($report);
//        echo '</pre>';
//        die();
        return  response()->json(['total' => $total, 'rows' => $report]);

    }

    public function exportBasicReport($builder)
    {
        Excel::create('Report', function($excel) use ($builder) {
            $excel->sheet('report', function($sheet) use($builder) {
                $sheet->appendRow(array(
                    'id', 'Phone', 'Sim number', 'Provider', 'Type', 'From', 'To', 'Dealer',
                    'Reference #', 'Duration (in days)', 'Price per day', 'SIM price', 'Total'
                ));
                $sheet->setColumnFormat(array('C' => '0'));
                $sheet->freezeFirstRowAndColumn();
                $builder->chunk(100, function($rows) use ($sheet)
                {
                    foreach ($rows as $row)
                    {
                        $sheet->appendRow(array(
                            $row->id, $row->phone->phone, $row->sim->number, $row->sim->provider->name,
                            $row->package->name, $row->landing, $row->departure, $row->creator->login,
                            $row->reference_number, $row->report->duration, $row->report->daily_sell_price,
                            $row->report->sim_sell_price, $row->report->total_sell_price + $row->report->sim_sell_price
                        ));
                    }
                });
            });
        })->download('xlsx');

    }

    public function exportFinancialReport($builder)
    {
      return  Excel::create('Report', function($excel) use ($builder) {
            $excel->sheet('report', function($sheet) use($builder) {
                $sheet->appendRow(array(
                    'id', 'Phone', 'Sim number', 'Provider', 'Type', 'From', 'To', 'Dealer',
                    'Duration (in days)', 'Daily sell price', 'Total sell price', 'SIM price',
                    'Package cost', 'Total Package cost', 'SIM cost', 'Total profit'
                ));
                $sheet->setColumnFormat(array('C' => '0'));
                $sheet->freezeFirstRowAndColumn();
                $builder->chunk(100, function($rows) use ($sheet)
                {
                    foreach ($rows as $row)
                    {
                        $sheet->appendRow(array(
                            $row->id, $row->phone->phone, $row->sim->number, $row->sim->provider->name,
                            $row->package->name, $row->landing, $row->departure, $row->creator->login,
                            $row->report->duration, $row->report->daily_sell_price, $row->report->total_sell_price,
                            $row->report->sim_sell_price, $row->report->package_cost, $row->report->total_package_cost,
                            $row->report->sim_cost, $row->report->total_profit,
                        ));
                    }
                });
            });
        });

    }


}
