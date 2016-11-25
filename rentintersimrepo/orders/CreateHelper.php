<?php
/**
 * Created by PhpStorm.
 * User: narek
 * Date: 11/25/16
 * Time: 2:15 PM
 */

namespace Rentintersimrepo\orders;

use Carbon\Carbon;


class CreateHelper
{
    public function setStartTime($datetime){
        return Carbon::createFromFormat('Y-m-d H:i:s', $datetime)
            ->subMinutes(30)
            ->toDateTimeString();
    }

    public function setEndTime($datetime){
        return Carbon::createFromFormat('Y-m-d H:i:s', $datetime)
            ->subMinutes(30)
            ->toDateTimeString();
    }

}