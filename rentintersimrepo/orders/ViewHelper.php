<?php
/**
 * Created by PhpStorm.
 * User: narek
 * Date: 12/2/16
 * Time: 12:14 PM
 */

namespace Rentintersimrepo\orders;

use Carbon\Carbon;

class ViewHelper
{
    public function present($datetime){
//        $date = Carbon::createFromFormat('Y-m-d H:i:s', $datetime);
        $date = Carbon::createFromTimestamp($datetime);
        $date->minute = ceil($date->minute/5)*5;
        $view = $date->format('d/m/Y H:i');
        return $view;
    }
}