<?php

/**
 * Created by PhpStorm.
 * User: narek
 * Date: 3/29/17
 * Time: 9:56 AM
 */
namespace Rentintersimrepo\report;

use App\Models\Order;
use App\Models\Report;
use App\Models\PlName;
use Rentintersimrepo\users\UserManager;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\Models\ReportHistory;

class ReportHelper
{
    protected $userManager;

    public function __construct()
    {

        $this->userManager = new UserManager();
    }

    public function getSimCost($order)
    {
        $pl = $this->userManager->getCostPl($order->creator->id, $order->package->provider->id);
        return $pl->cost;

    }

    public function getSimSell($order)
    {
        $pl = $this->userManager->getPl($order->creator->id, $order->package->provider->id);
        return $pl->cost;

    }

    public function getPackageSell($order)
    {
        $pl = $this->userManager->getPl($order->creator->id, $order->package->provider->id);
//        dd($pl);
            foreach ($pl->priceLists as $item){
                if ($item->package_id == $order->package_id)
                    return $item->cost;
            }
        return 0;
    }

    public function getPackageCost($order)
    {
        $pl = $this->userManager->getCostPl($order->creator->id, $order->package->provider->id);
//        dd($pl);
        foreach ($pl->priceLists as $item){
            if ($item->package_id == $order->package_id)
                return $item->cost;
        }
        return 0;
    }

    public function calculateInterval ($timestampFrom, $timestampTo)
    {
        $from = Carbon::createFromFormat('d/m/Y H:i', $timestampFrom);
        $to = Carbon::createFromFormat('d/m/Y H:i', $timestampTo);
        $from->setTime(0,0);
        $to->setTime(0,0);
        $seconds = $to->timestamp - $from->timestamp;
        if ($seconds == 0)
            return 1;
        $interval = ceil($seconds / 86400);
        return ++$interval;

    }

    public function calculateTotalProfit($order)
    {
        $duration = $this->calculateInterval($order->landing, $order->departure);
        $totalProfit = (($duration * $this->getPackageSell($order)) + $this->getSimSell($order)) -
            (($duration * $this->getPackageCost($order)) + $this->getSimCost($order));
        return $totalProfit;
    }

    public function calculateReport($order)
    {
        $report = new Report();
        $report->order_id = $order->id;
        $report->duration = $this->calculateInterval($order->landing, $order->departure);
        $report->daily_sell_price = $this->getPackageSell($order);
        $report->total_sell_price = $report->daily_sell_price * $report->duration;
        $report->sim_sell_price = $this->getSimSell($order);
        $report->package_cost = $this->getPackageCost($order);
        $report->total_package_cost = $report->package_cost * $report->duration;
        $report->sim_cost = $this->getSimCost($order);
        $report->total_profit = ($report->total_sell_price + $report->sim_sell_price) -
            ($report->total_package_cost + $report->sim_cost);
        return $report;
    }

    public function logReportChanges()
    {
        Log::info('Price List Event dispatched');
        $orders = Order::where('status', 'active')->get();
        foreach ($orders as $order){
            if ($order->report->histories == null){
                if (($order->report->daily_sell_price == $this->getPackageSell($order))
                    || ($order->report->sim_sell_price == $this->getSimSell($order))
                        || ($order->report->package_cost == $this->getPackageCost($order))
                            || ($order->report->sim_cost == $this->getSimCost($order)))
                    continue;
                    else $this->createNewHistory($order);
               }
            else {
                $story = $order->report->histories()->orderBy('created_at', 'desc')->first();
                    if (($story->new_package_sell == $this->getPackageSell($order))
                            || ($story->new_sim_sell == $this->getSimSell($order))
                            || ($story->new_package_cost == $this->getPackageCost($order))
                            || ($story->new_sim_cost == $this->getSimCost($order)))
                            continue;
                else {
                    //TODO create new story by copiing
                }

            }

        }

    }

    protected function createNewHistory ($order)
    {
        $history = new ReportHistory();
        $history->report_id = $order->report->id;
        $history->new_sim_cost = $this->getSimCost($order);
        $history->new_sim_sell = $this->getSimSell($order);
        $history->new_package_cost = $this->getPackageCost($order);
        $history->new_package_sell = $this->getPackageSell($order);
        $history->old_sim_cost = $order->report->sim_cost;
        $history->old_sim_sell = $order->report->sim_sell_price;
        $history->old_package_cost = $order->report->package_cost;
        $history->old_package_sell = $order->report->daily_sell_price;
        $history->save();
    }

}