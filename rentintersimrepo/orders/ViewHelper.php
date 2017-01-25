<?php
/**
 * Created by PhpStorm.
 * User: narek
 * Date: 12/2/16
 * Time: 12:14 PM
 */

namespace Rentintersimrepo\orders;

use App\Models\Phone;
use App\Models\Sim;
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
            if ($order->creator != null)
                $ordersArray[$key]['created_by'] = $order->creator->login;
            if ($order->editor != null)
                $ordersArray[$key]['updated_by'] = $order->editor->login;
            if ($order->sim != null)
                $ordersArray[$key]['provider'] = $order->sim->provider->name;
            else  $ordersArray[$key]['provider'] = Sim::withTrashed()->find($ordersArray[$key]['sim_id'])->provider->name;
            if($order->sim != null)
                $ordersArray[$key]['sim_id'] = $order->sim->number;
            else
                $ordersArray[$key]['sim_id'] = Sim::withTrashed()->find($ordersArray[$key]['sim_id'])->number;
            if ($ordersArray[$key]['phone_id'] != 0)
                if($order->phone != null)
                $ordersArray[$key]['phone_id'] = $order->phone->phone;
                else
                    $ordersArray[$key]['phone_id'] = Phone::withTrashed()->find($ordersArray[$key]['phone_id'])->phone;
            $ordersArray[$key]['from'] = $this->present($ordersArray[$key]['from']);
            $ordersArray[$key]['to'] = $this->present($ordersArray[$key]['to']);
//        $ordersArray[$key]['package_id'] = $order->package->name;
            if ($order->package != null)
            $ordersArray[$key]['package_name'] = $order->package->name;
//        $ordersArray[$key]['landing'] = $viewHelper->present($ordersArray[$key]['landing']);
//        $ordersArray[$key]['departure'] = $viewHelper->present($ordersArray[$key]['departure']);
            $ordersArray[$key]['duration'] = $this->calculateInterval($ordersArray[$key]['landing'], $ordersArray[$key]['departure']);
            unset($ordersArray[$key]['costumer_number']);
            unset($ordersArray[$key]['deleted_at']);

        }
        return $ordersArray;
    }

    public function totalDuration($solvedArray)
    {
//        $total = new DateInterval('P0Y0DT0H0M');
//        dd($total);
        foreach ($solvedArray as $item){
//            $diff = $this->calculateInterval($item['landing'], $item['departure']);
//            $total->y += $diff->y;
//            $total->m += $diff->m;
//            $total->d += $diff->d;
//            $total->h += $diff->h;
//            $total->i += $diff->i;
//            $total->s += $diff->s;


        }
//        $interval_spec = 'P'.$total->y.'Y'.$total->m.'M'.$total->d.'DT'.$total->h.'H'.$total->i.'M'.$total->s.'S';
//        return CarbonInterval::create($total->y, $total->m, 0, $total->d, $total->h, $total->i, $total->s);
            return -1;
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
        $ordersd = clone($orders);
//        dd($orders);
        $counts = ([
            'All' => $orders->count(),
            'active' => $orders->filter('active')->count(),
            'pending' => $ordersp->filter('pending')->count(),
            'waiting' => $ordersw->filter('waiting')->count(),
            'done' => $ordersd->filter('done')->count(),
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
//        return CarbonInterval::create($interval->y, $interval->m, 0, $interval->d, $interval->h, $interval->i, $interval->s);
        $from = Carbon::createFromFormat('d/m/Y H:i', $timestampFrom);
        $to = Carbon::createFromFormat('d/m/Y H:i', $timestampTo);
        $from->setTime(0,0);
        $to->setTime(0,0);
        $seconds = $to->timestamp - $from->timestamp;
        if ($seconds == 0)
            return 1;
        $interval = ceil($seconds / 86400);
////        if ($seconds % 86400 > 0)
////            $interval++;
//        $resultDay = $from->addDays($interval);
////        dd($resultDay);
//        if ($resultDay->day != $to->day)
//            $interval++;

//        dd($interval);

        return ++$interval;

    }
    public function prepareExport($orders, $propose)
    {
        foreach ($orders as $order){
            unset($order['from']);
            unset($order['to']);
            unset($order['remark']);
            unset($order['package_id']);
            unset($order['updated_by']);
            unset($order['created_at']);
            unset($order['updated_at']);
            unset($order['package_name']);
            unset($order['sim']);
            $order['Phone'] = $order['phone_id'];
            unset($order['phone_id']);
            $order['Sim number'] = $order['sim_id'];
            unset($order['sim_id']);
            $order['Provider'] = $order['provider'];
            unset($order['provider']);
            $order['From'] = $order['landing'];
            unset($order['landing']);
            $order['To'] = $order['departure'];
            unset($order['departure']);
            $order['Dealer'] = $order['created_by'];
            unset($order['created_by']);
            $order['Reference #'] = $order['reference_number'];
            unset($order['reference_number']);
            if ($propose == 'report')
            $order['Duration (in days)'] = $order['duration'];
            unset($order['duration']);
            if ($propose == 'order')
            $order['Status'] = $order['status'];
            unset($order['status']);


        }
        return $orders;
    }

}