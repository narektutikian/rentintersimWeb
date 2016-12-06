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
            ->subMinutes(30)
            ->timestamp;
    }

    public function setEndTime($datetime){
        return Carbon::createFromTimestamp($datetime)
            ->subMinutes(30)
            ->timestamp;
    }

    public function getSimId($sim){
        return Sim::where('number', $sim)->first()->id;
    }

    public function getNumber($order){
//        dd($order);
        $number = null;
        $sim = $order->sim;
        if ($sim->state == 'available'){
            $number = Phone::where([['is_active', 1],['package_id', $order->package_id], ['state', 'Not in use']])->first();

            if ($number != null){

                $this->setStatus($number, $sim, 'pending');
//                dd($number);
                return $number;
            }
            else {

                return $this->retryGetNumber($order);
            }
        }
        return $number;
    }

    public function retryGetNumber($order)
    {
        $number = null;
        if ($order->sim->state == 'available'){
            $oldOrders = Order::where([['status', 'Pending'], ['package_id', $order->package_id]])->orderby('to', 'asc')->get();

            foreach ($oldOrders as $oldOrder){
                if ($this->isTimeCompatible($order, $oldOrder)) {
                    if ($this->isNumberCompatible($order, $oldOrder)){
                        $number = Phone::find($oldOrder->phone_id);
                        $order->status = 'Pending';
                        $order->phone_id = $number->id;
                        $order->save();
//                        dd($number);
                         break;
                     }
                }
                continue;
            }
        }
        return $number;
    }

    protected function setStatus($number, $sim, $status)
    {
        $number->state = $status;
        $number->save();
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
        $phone= Phone::find($oldOrder->phone_id);
        $allOrders = $phone->orders;
        if($allOrders->count() > 0){
//            dd($allOrders);
            foreach ($allOrders as $order){
                  if($this->isTimeCompatible($newOrder, $order))
                    continue;
                    else return false;
                }

        }
        return true;
    }

}