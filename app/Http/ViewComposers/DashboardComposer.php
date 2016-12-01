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
           'distributors' => User::distributor($id)->count(),
           'dealers' => User::dealer($id)->count(),
           'subdealers' => User::subdealer($id)->count(),
        ]);
        $counts = ([
            'All' => Phone::all()->count(),
            'Active' => Phone::filter('Active')->count(),
            'Pending' => Phone::filter('Pending')->count(),
            'Not in use' => Phone::filter('Not in use')->count(),
        ]);

        $view->with('viewName', $view->getName())
            ->with('net', $net)
            ->with('counts', $counts);
    }
}