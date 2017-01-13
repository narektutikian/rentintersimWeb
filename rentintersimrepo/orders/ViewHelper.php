<?php
/**
 * Created by PhpStorm.
 * User: narek
 * Date: 12/2/16
 * Time: 12:14 PM
 */

namespace Rentintersimrepo\orders;

use Carbon\Carbon;
use Auth;
use App\Models\Order;
use Carbon\CarbonInterval;
use \DateInterval;

class ViewHelper
{
    public function present($datetime){
//        $date = Carbon::createFromFormat('Y-m-d H:i:s', $datetime);
        $date = Carbon::createFromTimestamp($datetime);
        $date->minute = ceil($date->minute/5)*5;
        $view = $date->format('d/m/Y H:i');
        return $view;
    }

    public  function solveOrderList($orders){
        $ordersArray = $orders;
//        dd($orders);
        foreach ($orders as $key => $order) {
            $ordersArray[$key]['created_by'] = $order->creator->login;
            $ordersArray[$key]['updated_by'] = $order->editor->login;
            $ordersArray[$key]['sim_id'] = $order->sim->number;
            if ($ordersArray[$key]['phone_id'] != 0)
                $ordersArray[$key]['phone_id'] = $order->phone->phone;
            $ordersArray[$key]['provider'] = $order->sim->provider->name;
            $ordersArray[$key]['from'] = $this->present($ordersArray[$key]['from']);
            $ordersArray[$key]['to'] = $this->present($ordersArray[$key]['to']);
//        $ordersArray[$key]['package_id'] = $order->package->name;
            $ordersArray[$key]['package_name'] = $order->package->name;
//        $ordersArray[$key]['landing'] = $viewHelper->present($ordersArray[$key]['landing']);
//        $ordersArray[$key]['departure'] = $viewHelper->present($ordersArray[$key]['departure']);
            $ordersArray[$key]['duration'] = $this->format_interval($this->calculateInterval($ordersArray[$key]['landing'], $ordersArray[$key]['departure']));
            unset($ordersArray[$key]['costumer_number']);
            unset($ordersArray[$key]['deleted_at']);

        }
        return $ordersArray;
    }

    public function totalDuration($solvedArray)
    {
        $total = new DateInterval('P0Y0DT0H0M');
//        dd($total);
        foreach ($solvedArray as $item){
            $diff = $this->calculateInterval($item['landing'], $item['departure']);
            $total->y += $diff->y;
            $total->m += $diff->m;
            $total->d += $diff->d;
            $total->h += $diff->h;
            $total->i += $diff->i;
            $total->s += $diff->s;

        }
//        $interval_spec = 'P'.$total->y.'Y'.$total->m.'M'.$total->d.'DT'.$total->h.'H'.$total->i.'M'.$total->s.'S';
        return CarbonInterval::create($total->y, $total->m, 0, $total->d, $total->h, $total->i, $total->s);

    }

    public function getCounts($userManager){
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
    }

    /**
     * Format an interval to show all existing components.
     * If the interval doesn't have a time component (years, months, etc)
     * That component won't be displayed.
     *
     * @param DateInterval $interval The interval
     *
     * @return string Formatted interval string.
     */
    function format_interval(DateInterval $interval) {
        $result = "";
        if ($interval->y) { $result .= $interval->format("%y y "); }
        if ($interval->m) { $result .= $interval->format("%m m "); }
        if ($interval->d) { $result .= $interval->format("%d d "); }
        if ($interval->h) { $result .= $interval->format("%h h "); }
        if ($interval->i) { $result .= $interval->format("%i m "); }
        if ($interval->s) { $result .= $interval->format("%s s "); }

        return $result;
    }

    private function calculateInterval ($timestampFrom, $timestampTo)
    {
        $from = Carbon::createFromFormat('d/m/Y H:i', $timestampFrom);
        $to = Carbon::createFromFormat('d/m/Y H:i', $timestampTo);
//        $interval =
//        return CarbonInterval::create($interval->y, $interval->m, 0, $interval->d, $interval->h, $interval->i, $interval->s);
        return $from->diff($to);

    }

}