<?php
/**
 * Created by PhpStorm.
 * User: narek
 * Date: 11/25/16
 * Time: 2:15 PM
 */

namespace Rentintersimrepo\orders;

use Carbon\Carbon;
use App\Models\Sim;
use App\Models\Phone;
use App\Models\Order;


class CreateHelper
{
    public function setStartTime($datetime){
        return Carbon::createFromTimestamp($datetime)
            ->subMinutes(60)
            ->timestamp;
    }

    public function setEndTime($datetime){
        return Carbon::createFromTimestamp($datetime)
            ->addHours(4)
            ->timestamp;
    }

    public function getSim($sim){
        $simObj = Sim::where('number', $sim)->first();
//        if ($simObj->count())
//            return 'sim not found';
        return $simObj;
    }

    public function getNumber($order){
//        dd($order);
        $number = null;
        $number = $this->retryGetNumber($order);
        if ($number == null){
             $number = $this->getNewNumber($order);
        }
        return $number;
    }

    protected function getNewNumber($order)
    {
        $number = null;

            $phone = Phone::where([['is_active', 1], ['package_id', $order->package_id], ['state', 'not in use']])->first();
//            dd($phone);
            if ($phone != null)
                if($phone->exists){
                $number = $phone->id;
//                dd($number);
                $order->phone_id = $number;
                $order->save();
                $this->setStatus($order, 'pending');

            }

        return $number;
    }

    public function retryGetNumber($order)
    {
        $number = null;

            $oldOrders = Order::where([['package_id', $order->package_id], ['phone_id', '!=', 0]])->orderby('to', 'asc')->get();
            foreach ($oldOrders as $oldOrder){
                if ($this->isTimeCompatible($order, $oldOrder)) {
                    if ($this->isNumberCompatible($order, $oldOrder)){
                        $number = $oldOrder->phone_id;

                        $order->phone_id = $number;
                        $order->save();

                        $this->setStatus($order, 'pending');
//                        dd($number);
                         break;
                     }
                }
                continue;
            }

        return $number;
    }

    protected function setStatus($order, $status)
    {
        $order->status = $status;
        $order->save();
        $number = $order->phone;
//        dd($order);
        $number->state = $status;
        $number->save();
        $sim = $order->sim;
        $sim->state = $status;
        $sim->save();
    }

    protected function isTimeCompatible($newOrder, $oldOrder)
    {
        if ($newOrder->to < $oldOrder->to){
            if ($newOrder->from < $oldOrder->to)
                return true;
        }
        if ($newOrder->from > $oldOrder->to){
             return true;
        }
        return false;
    }

    protected function isNumberCompatible($newOrder, $oldOrder)
    {
        $allOrders = Order::where('phone_id', $oldOrder->phone_id);
        if($allOrders->count() > 0){
//            dd($allOrders);
            foreach ($allOrders->get() as $order){
                  if($this->isTimeCompatible($newOrder, $order))
                    continue;
                    else return false;
                }

        }
        return true;
    }

    public function startActivation()
    {
     $now = Carbon::now('Asia/Yerevan');
//        dd($now->timestamp);
        $orders = Order::where('status', 'pending')->where('from', '<', $now->timestamp+150)->get();
//        $orders = Order::where('status', 'pending')->where('from', '<', $now->timestamp+150)->where('from', '>', $now->timestamp-150)->get();
//        $orders = Order::where('status', 'pending')->get();
        if ($orders != null){
            foreach ($orders as $order){
                $this->activate($order->id);
            }
        }
//        dd($orders, $now->timestamp);
    }

    public function activate ($orderId)
    {
        $order = Order::find($orderId);
        if ($order == null)
            exit();
//        $res = file_get_contents(
//            "http://176.35.171.143:8085/api/vfapi.php?key=7963ad6960b1088b94db2c32f2975e86&call=simswap&cli=0"
//            .$order->phone->number."&sim=".$order->sim->number);
        $phone = $order->phone;
        $phone->current_sim_id = $order->sim_id;
        $phone->save();
        $this->setStatus($order, 'active');
    }

    public function startDeactivation()
    {
     $now = Carbon::now();
//        dd($now->timestamp);
        $orders = Order::where('status', 'active')->where('to', '<', $now->timestamp+150)->get();
//        $orders = Order::where('status', 'active')->get();
        if ($orders != null){
            foreach ($orders as $order){
                $this->deactivate($order->id);
            }
        }
//        dd($orders, $now->timestamp);
    }

    public function deactivate ($orderId)
    {
        $order = Order::find($orderId);
        if ($order == null)
            exit();
        $phone = $order->phone;
        $phone->current_sim_id = $phone->initial_sim_id;
        $order->status = 'finished';
        $order->save();
//        $res = file_get_contents(
//            "http://176.35.171.143:8085/api/vfapi.php?key=7963ad6960b1088b94db2c32f2975e86&call=simswap&cli=0"
//            .$order->phone->number."&sim=".$phone->parking_sim->number);
        if(Order::where('phone_id', $order->phone_id)->count() > 0) //not tested
            $phone->state = 'not in use';
        else $phone->state = 'pending';

        $sim = $order->sim;
        $sim->state = 'available';

        $sim->save();
        $phone->save();
        $order->delete();

    }

}