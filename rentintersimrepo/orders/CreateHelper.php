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
    public function getNumber($simId, $packageId){
        $number = null;
        $sim = Sim::find($simId);
        if ($sim->state == 'available'){
            $number = Phone::where([['is_active', 1],['package_id', $packageId], ['state', 'Not in use']])->first();

            if ($number){
                $number->state = 'Pending';
                $number->save();
                $sim->state = 'pending';
                $sim->save();
                return $number;
            }
        }
        return null;
    }

}