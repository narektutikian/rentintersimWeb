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
use Auth;
use Rentintersimrepo\Users\UserManager;



class UserComposer
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
        $net = new UserManager();
        $net = $net->getNetworkFromCache(Auth::user()->id);


        $users = User::select('id', 'login', 'supervisor_id', 'level')
            ->where('id', '!=', Auth::user()->id)
            ->where('type', 'admin')
            ->orderBy('level', 'desc')
            ->whereIn('id', $net)
            ->get()->toArray();
        $view->with('viewName', $view->getName())
                ->with('users', $users);
    }
}