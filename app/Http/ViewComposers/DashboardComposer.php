<?php
/**
 * Created by PhpStorm.
 * User: narek
 * Date: 11/30/16
 * Time: 7:10 PM
 */

namespace App\Http\ViewComposers;
use Illuminate\View\View;
use App\User;
use App\Models\Phone;
use Auth;
use App\Models\Order;
use App\Models\Report;
use Carbon\Carbon;
use DB;



class DashboardComposer
{
    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
//    protected $users;

    /**
     * Create a new profile composer.
     *
     * @param
     * @return void
     */
    public function __construct()
    {
        // Dependencies automatically resolved by service container...
//        $this->users = $users;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
//        $id = Auth::user()->id;

        $neverUsedNumbers = Phone::whereNotIn('id', function ($q){
           $q->select('phone_id')->from('orders');
        })->count();
//        dd($neverUsedNumbers);
        $net = ([
           'distributors' => User::where('level', 'distributor')->count(),
           'dealers' => User::where('level', 'dealer')->count(),
           'subdealers' => User::where('level', 'subdealer')->count(),
        ]);
        $counts = ([
            'All' => Phone::all()->count(),
            'active' => Order::filter('active')->count(),
            'pending' => Order::filter('pending')->count(),
            'not in use' => $neverUsedNumbers,
        ]);

        $firstDayOfThisMonth  = Carbon::now();
        $firstDayOfThisMonth->day = 1;
        $firstDayOfThisMonth->setTime(0,0,0);
        $lastDayOfThisMonth = clone $firstDayOfThisMonth;
        $lastDayOfThisMonth->day = date("t");
        $lastDayOfThisMonth->setTime(23,59,59);
//        dd($firstDayOfThisMonth->timestamp, $lastDayOfThisMonth->timestamp);
//        die();
        $totalActiveNumberCount = Order::withTrashed()->where([['from', '>=', $firstDayOfThisMonth->timestamp],
                                                            ['from', '<=', $lastDayOfThisMonth->timestamp]])
            ->whereIn('status', ['pending', 'active', 'done'])->distinct('phone_id')->count('phone_id');




        $totalDuration = Report::whereIn('order_id', function ($q) use ($firstDayOfThisMonth, $lastDayOfThisMonth) {
            $q->select('id')->from('orders')
                ->where([['from', '>=', $firstDayOfThisMonth->timestamp],
                    ['from', '<=', $lastDayOfThisMonth->timestamp]])
                ->whereIn('status', ['pending', 'active', 'done']);
        })->sum('duration');
        $avgMonthlyTime = floor((($totalActiveNumberCount * $totalDuration) / (Phone::count() * date("t"))) * 100);

//       dd($avgMonthlyTime);

        $view->with('viewName', $view->getName())
            ->with('net', $net)
            ->with('counts', $counts)
            ->with('avgMonthlyTime', $avgMonthlyTime);
    }
}