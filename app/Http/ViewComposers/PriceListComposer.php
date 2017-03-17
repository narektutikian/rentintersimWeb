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
use App\Models\PlName;
use Rentintersimrepo\users\UserManager;



class PriceListComposer
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
//        $net = new UserManager();
//        $net = $net->getNetworkFromCache(Auth::user()->id);
        $defaultCost = PlName::where('id', 1)->with('priceLists', 'priceLists.package')->first()->toArray();
        $default = PlName::where('id', 2)->with('priceLists', 'priceLists.package')->first()->toArray();
        $myPl = PlName::where('id', Auth::user()->pl_name_id)->with('priceLists')->get();
        $createdPl = PlName::where('created_by', Auth::user()->id)->where('id', '!=', Auth::user()->pl_name_id)->with('priceLists')->get();

//        var_dump($defaultCost);
//        die();
//        dd($defaultCost);

        $view->with('viewName', $view->getName())
                ->with('default', $default)
                ->with('defaultCost', $defaultCost);
    }
}