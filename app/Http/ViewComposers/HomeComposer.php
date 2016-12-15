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



class HomeComposer
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
        $specials = Phone::where([['is_active', 1], ['is_special', 1], ['state', 'not in use']])->get()->toArray();

        $view->with('viewName', $view->getName())
            ->with('specials', $specials);
    }
}