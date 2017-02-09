<?php
/**
 * Created by PhpStorm.
 * User: narek
 * Date: 11/25/16
 * Time: 2:15 PM
 */

namespace Rentintersimrepo\orders;


use App\Mail\notifications;
use Carbon\Carbon;
use App\Models\Sim;
use App\Models\Phone;
use App\Models\Order;
use App\Models\Activation;
use Illuminate\Support\Facades\Log;
use Mail;
use DB;

class CreateHelper
{
    public function setStartTime($datetime){
//        $date = Carbon::createFromTimestamp($datetime);
        $date = Carbon::createFromFormat('d/m/Y H:i', $datetime)->subHours(1);
        if ($date->hour >= 3 && $date->hour <= 7){
            $date->setTime(1,0);
           }
        return $date->timestamp;
    }

    public function setEndTime($datetime){
//        $date = Carbon::createFromTimestamp($datetime)
        $date = Carbon::createFromFormat('d/m/Y H:i', $datetime);
        return $date->subHours(3)->timestamp;
    }

    public function getSim($sim){
        $simObj = Sim::where('number', $sim)->first();
//        if ($simObj->count())
//            return 'sim not found';
        return $simObj;
    }

    public function getNumber($order){
//        dd($order);
        DB::transaction(function () use ($order) {
            $number = null;
            $number = $this->retryGetNumber($order);
            if ($number == null) {
                $number = $this->getNewNumber($order);
            }

            return $number;
        },5 );
    }

    protected function getNewNumber($order)
    {
//        Log::info('Create Helper -> getNewNumber');
        $number = null;

        $phone = Phone::where([['is_active', 1], ['package_id', $order->package_id], ['state', 'not in use'], ['is_special', '0']])->first();
//            dd($phone);
        if ($phone != null)
            if($phone->exists){
                $number = $phone->id;
//                dd($number);
                $this->assignNumber($order, $number);
            }

        return $number;
    }

    public function retryGetNumber($order)
    {
//        Log::info('Create Helper -> retryGetNewNumber'. date('H:i:s'));
        $number = null;

        $oldOrders = Order::where([['package_id', $order->package_id], ['phone_id', '!=', 0], ['status', '!=', 'done' ]])->whereNotIn('phone_id',
            function ($q) {
             $q->select('id')->from('phones')->where('is_special', 1);
            })
            ->orderby('id', 'asc')->get();
        foreach ($oldOrders as $oldOrder){
            if ($this->isTimeCompatible($order, $oldOrder)) {
                if ($this->isNumberCompatible($order, $oldOrder)){
                    $number = $oldOrder->phone_id;
                    $this->assignNumber($order, $number);
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
        if ($number->state != 'active'){
        $number->state = $status;
        $number->save();
        }
        $sim = $order->sim;
        $sim->state = $status;
        $sim->save();
        $this->sendMail($order->id);
    }

    protected function isTimeCompatible($newOrder, $oldOrder)
    {
//
        if ($newOrder->from <= $oldOrder->to + 72000  && $newOrder->to >= $oldOrder->from - 72000){
//            Log::info('Create Helper -> isTimeCompatible : passed for new order: '. $newOrder->id. ', old order:  '. $oldOrder->id);
            return false;
        }

        else{
//
            return true;
        }


    }

    protected function isNumberCompatible($newOrder, $oldOrder)
    {
//        Log::info('Create Helper -> isNumberCompatible'. date('H:i:s'));
        $allOrders = Order::where('phone_id', $oldOrder->phone_id);
        $count = clone ($allOrders);
        $c = $count->count();
        if($c > 0){
//            dd($allOrders);
            foreach ($allOrders->get() as $order){
                if($this->isTimeCompatible($newOrder, $order))
                    continue;
                else
                    return false;
            }

        }
        else
            return true;
        return true;
    }

    public function setNumber($orderid, $numberid)
    {
//        dd($orderid);

        $order = Order::find($orderid);
        $number = Phone::find($numberid);
        if ($order != null && $number != null){
            if ($order->package_id != $number->package_id)
                return 'Insufficient package selected. The package of this number is #'. $number->package_id;
            if ($number->state == 'not in use') {
                $this->assignNumber($order, $number->id);
            } else {

                $oldOrders = Order::where([['phone_id', $numberid]])->orderby('id', 'asc')->get();
                foreach ($oldOrders as $oldOrder){
                    if ($this->isTimeCompatible($order, $oldOrder)) {
                        if ($this->isNumberCompatible($order, $oldOrder)){
                            $numberid = $oldOrder->phone_id;
                            $this->assignNumber($order, $oldOrder->phone_id);
//                        dd($number);
                            break;
                        }
                    }
                    continue;
                }

                return 'This number is in use for selected period of time';
            }
            return $number->id;
        } else {return 'Number or Order does not exist';}
        return 'unknown error';
    }

    protected function assignNumber($order, $phoneID)
    {
        $order->phone_id = $phoneID;
        $order->save();
        $this->setStatus($order, 'pending');
    }

    public function startActivation()
    {
        ini_set('max_execution_time', 90);
        $now = Carbon::now();
//        dd($now->timestamp);
        $orders = Order::where('status', 'pending')->where('from', '<', $now->timestamp+150)->get();
//        $orders = Order::where('status', 'pending')->where('from', '<', $now->timestamp+150)->where('from', '>', $now->timestamp-150)->get();
//        $orders = Order::where('status', 'pending')->get();
        if ($orders != null){
            foreach ($orders as $order){
                $this->activate($order->id);
                sleep(10);
            }
        }
//        dd($orders, $now->timestamp);
    }

    public function activate ($orderId)
    {
        DB::transaction(function () use ($orderId) {
        $order = Order::find($orderId);
        if ($order->status != 'pending')
            exit();
        if ($order == null)
            exit();
        $res = null;
        sleep(5);
        if (env('APP_ENV') == 'local')
            $res = 'L';
        else
            $res = file_get_contents("http://176.35.171.143:8086/api/vfapi.php?key=7963ad6960b1088b94db2c32f2975e86&call=simswap&cli=".$order->phone->phone."&sim=".$order->sim->number);
//        $res = 0;
        Activation::forceCreate([
            'phone_number' =>  $order->phone->phone,
            'sim_number' => $order->sim->number,
            'call' => 'activate',
            'answer' => $res,
            'order_id' => $order->id
        ]);

        $phone = $order->phone;
        $phone->current_sim_id = $order->sim_id;
        $phone->save();
        $order->from = Carbon::createFromFormat('d/m/Y H:i', $order->landing)->timestamp;
        $order->save();
        $this->setStatus($order, 'active');
        }, 5);
    }

    public function startDeactivation()
    {
        ini_set('max_execution_time', 90);
        $now = Carbon::now();
//        dd($now->timestamp);
        $orders = Order::where('status', 'active')->where('to', '<', $now->timestamp)->get();
//        dd($orders);
//        $orders = Order::where('status', 'active')->get();
        if ($orders != null){
            foreach ($orders as $order){
                $this->deactivate($order->id);
                sleep(10);
            }
        }
//        dd($orders, $now->timestamp);
    }

    public function deactivate ($orderID)
    {
        DB::transaction(function () use ($orderID) {
            $order = Order::find($orderID);
        if ($order == null)
            exit();
        $phone = $order->phone;
        $phone->current_sim_id = $phone->initial_sim_id;

        sleep(5);
        if (env('APP_ENV') == 'local')
            $res = 'L';
        else
        $res = file_get_contents("http://176.35.171.143:8086/api/vfapi.php?key=7963ad6960b1088b94db2c32f2975e86&call=simswap&cli=".$order->phone->phone."&sim=".$phone->parking_sim->number);
//        $res = 0;
        Activation::forceCreate([
            'phone_number' =>  $order->phone->phone,
            'sim_number' => $phone->parking_sim->number,
            'call' => 'deactivate',
            'answer' => $res,
            'order_id' => $order->id
        ]);

        $this->freeResources($order, 'done');
    }, 5);

    }

    public function freeResources ($order, $status)
    {
        if ($order->status != 'waiting'){
            $phone = $order->phone;

            $phone->state = 'not in use';
            if(Order::where('phone_id', $order->phone_id)->where('status', 'pending')->count() > 1) //not tested
                $phone->state = 'pending';

                if (Order::where('phone_id', $order->phone_id)->where('status', 'active')->count() > 0 && $status != 'done')
                    $phone->state = 'active';

            $phone->save();
        }
        $order->status = $status;
        $order->save();

        $sim = $order->sim;
        $sim->state = 'available';

        $sim->save();
        $this->sendMail($order->id);
        if ($status == 'deleted')
        $order->delete();
    }

    public function sendMail($orderID)
    {
        $order = Order::withTrashed()->find($orderID);
        Mail::to($order->creator->email, $order->creator->name)
            ->queue(new notifications($orderID));
    }

}