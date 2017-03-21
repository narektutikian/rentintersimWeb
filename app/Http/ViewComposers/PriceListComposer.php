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

        $user = Auth::user();
        if ($user->type != 'admin')
            $user = User::find(Auth::user()->supervisor_id);


//        $net = new UserManager();
//        $net = $net->getNetworkFromCache(Auth::user()->id);
        $list['priceLists'] = array();
        $providers = DB::table('providers')->where('deleted_at', null)->get();
        foreach ($providers as $key=>$provider){
            $list['priceLists'][$key]['providerName'] = $provider->name;
            $list['priceLists'][$key]['providerId'] = $provider->id;
            $defaultID = PlName::where('provider_id', $provider->id)->where('name', 'Default')->first();
            if ($defaultID != null)
                $list['priceLists'][$key]['defaultId'] = $defaultID->id;
            $myPl = $user->priceList()->where([['provider_id', $provider->id],['name', '!=', 'Default']])->first();
            if ($myPl != null)
                $list['priceLists'][$key]['myPriceListId'] = $myPl->id;
            else
                if ($defaultID != null){
                 $list['priceLists'][$key]['myPriceListId'] = $defaultID->id;
                    $myPl = $defaultID;
                }
            $iCreated = PlName::select('id','name')
                ->where([['provider_id', $provider->id],
                        ['created_by', $user->id],
                        ['name', '!=', 'Default_cost']])
                ->whereNotIn('id', [$defaultID->id, $myPl->id])->get()->toArray();
            if ($iCreated != null)
                $list['priceLists'][$key]['iCreated'] = $iCreated;
            else
                $list['priceLists'][$key]['iCreated'] = [];
        }


//        var_dump($defaultCost);
//        die();
//        dd($myPl);

        $view->with('viewName', $view->getName())->with('list', $list);
    }
}