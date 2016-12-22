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
use App\Models\Activation;
use Illuminate\Support\Facades\Log;


class CreateHelper
{
    public function setStartTime($datetime){
        return Carbon::createFromTimestamp($datetime)
            ->addHours(1)
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
        Log::info('Create Helper -> getNewNumber'. date('H:i:s'));
        $number = null;

        $phone = Phone::where([['is_active', 1], ['package_id', $order->package_id], ['state', 'not in use'], ['is_special', '0']])->first();
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
//        Log::info('Create Helper -> retryGetNewNumber'. date('H:i:s'));
        $number = null;

        $oldOrders = Order::where([['package_id', $order->package_id], ['phone_id', '!=', 0]])->orderby('id', 'asc')->get();
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
        if ($number->state != 'active'){
        $number->state = $status;
        $number->save();
        }
        $sim = $order->sim;
        $sim->state = $status;
        $sim->save();
    }

    protected function isTimeCompatible($newOrder, $oldOrder)
    {
//        Log::info('Create Helper -> isTimeCompatible');
        if ($newOrder->from <= $oldOrder->to + 86400  && $newOrder->to >= $oldOrder->from - 86400){
//            Log::info('Create Helper -> isTimeCompatible : passed for new order: '. $newOrder->id. ', old order:  '. $oldOrder->id);
            return false;
        }

        else{
//            Log::info('Create Helper -> isTimeCompatible : failed'  );
            return true;
        }


        /*if ($newOrder->to < $oldOrder->to){
            if ($newOrder->from < $oldOrder->to)
                return true;
        }
        if ($newOrder->from > $oldOrder->to){
             return true;
        }
        return false;*/
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
                return response()->json(['Insufficient type selected'], 403);
            $order->phone_id = $number->id;
            $order->save();
            $this->setStatus($order, 'pending');
            return $number;
        } else {return response()->json(['Number or Order does not exist'], 403);}
        return response()->json(['unknown error'], 403);
    }

    public function startActivation()
    {
        $now = Carbon::now();
//        dd($now->timestamp);
        $orders = Order::where('status', 'pending')->where('from', '<', $now->timestamp+150)->get();
//        $orders = Order::where('status', 'pending')->where('from', '<', $now->timestamp+150)->where('from', '>', $now->timestamp-150)->get();
//        $orders = Order::where('status', 'pending')->get();
        if ($orders != null){
            foreach ($orders as $order){
                $this->activate($order->id);
                sleep(15);
            }
        }
//        dd($orders, $now->timestamp);
    }

    public function activate ($orderId)
    {
        $order = Order::find($orderId);
        if ($order == null)
            exit();
        sleep(5);
//        $res = file_get_contents("http://176.35.171.143:8086/api/vfapi.php?key=7963ad6960b1088b94db2c32f2975e86&call=simswap&cli=0".$order->phone->phone."&sim=".$order->sim->number);
        $res = 0;
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
        $this->setStatus($order, 'active');
    }

    public function startDeactivation()
    {
        $now = Carbon::now();
//        dd($now->timestamp);
        $orders = Order::where('status', 'active')->where('to', '<', $now->timestamp)->get();
//        dd($orders);
//        $orders = Order::where('status', 'active')->get();
        if ($orders != null){
            foreach ($orders as $order){
                $this->deactivate($order);
                sleep(15);
            }
        }
//        dd($orders, $now->timestamp);
    }

    public function deactivate ($order)
    {

        if ($order == null)
            exit();
        $phone = $order->phone;
        $phone->current_sim_id = $phone->initial_sim_id;

        sleep(5);
//        $res = file_get_contents("http://176.35.171.143:8086/api/vfapi.php?key=7963ad6960b1088b94db2c32f2975e86&call=simswap&cli=0".$order->phone->phone."&sim=".$phone->parking_sim->number);
        $res = 0;
        Activation::forceCreate([
            'phone_number' =>  $order->phone->phone,
            'sim_number' => $phone->parking_sim->number,
            'call' => 'deactivate',
            'answer' => $res,
            'order_id' => $order->id
        ]);

        $this->freeResources($order, 'suspended');

    }

    public function freeResources ($order, $status)
    {
        if ($order->status != 'waiting'){
            $phone = $order->phone;
            if(Order::where('phone_id', $order->phone_id)->where('status', 'pending')->count() > 1) //not tested
                $phone->state = 'pending';
                if (Order::where('phone_id', $order->phone_id)->where('status', 'active')->count() > 0 && $status != 'suspended')
                    $phone->state = 'active';
            else $phone->state = 'not in use';
            $phone->save();
        }
        $order->status = $status;
        $order->save();

        $sim = $order->sim;
        $sim->state = 'available';

        $sim->save();
        $order->delete();
    }

}