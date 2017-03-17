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
use DB;



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
        $list['priceLists'] = array();
        $providers = DB::table('providers')->where('deleted_at', null)->get();
        foreach ($providers as $key=>$provider){
            $list['priceLists'][$key]['name'] = $provider->name;
            $list['priceLists'][$key]['id'] = $provider->id;
            $defaultID = PlName::where('provider_id', $provider->id)->first();
            if ($defaultID != null)
            $list['priceLists'][$key]['default'] = $defaultID->id;
            $list['priceLists'][$key]['myPriceList'] = Auth::user()->pl_name_id;
//TODO continue building this array
        }
        dd($list);


//        var_dump($defaultCost);
//        die();
//        dd($myPl);

        $view->with('viewName', $view->getName());
    }
}