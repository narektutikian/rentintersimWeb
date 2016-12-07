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

}