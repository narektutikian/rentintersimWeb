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

            unset($ordersArray[$key]['costumer_number']);
            unset($ordersArray[$key]['deleted_at']);

        }
        return $ordersArray;
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
}