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
        $id = Auth::user()->id;
        $net = ([
           'distributors' => User::where('level', 'distributor')->count(),
           'dealers' => User::where('level', 'dealer')->count(),
           'subdealers' => User::where('level', 'subdealer')->count(),
        ]);
        $counts = ([
            'All' => Phone::all()->count(),
            'active' => Order::filter('active')->count(),
            'pending' => Order::filter('pending')->count(),
            'not in use' => Phone::filter('not in use')->count(),
        ]);

        $view->with('viewName', $view->getName())
            ->with('net', $net)
            ->with('counts', $counts);
    }
}