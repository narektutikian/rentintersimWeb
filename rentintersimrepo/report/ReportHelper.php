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

}