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
use Rentintersimrepo\users\UserManager;



class ReportComposer
{
    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    protected $userManager;

    /**
     * Create a new profile composer.
     *
     * @param
     * @return void
     */
    public function __construct(UserManager $userManager)
    {
        // Dependencies automatically resolved by service container...
        $this->userManager = $userManager;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $authUser = Auth::user();
        $level = [$authUser->level];
        $level = $this->userManager->subTyps($level[0]);
        $net = $this->userManager->subNetID($this->userManager->getMyFlatNetwork($authUser->id));
        $users = User::select('id', 'login', 'supervisor_id', 'type')->whereIn('id', $net)->where('type', 'admin')->get();


//        $id = Auth::user()->id;


        $view->with('viewName', $view->getName())
            ->with('level', $level)
            ->with('users', $users);
    }
}