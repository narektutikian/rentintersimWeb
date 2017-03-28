<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PlName;
use Illuminate\Support\Facades\Auth;
use DB;
use Rentintersimrepo\users\UserManager;
use Symfony\Component\Yaml\Tests\A;

class PriceListController extends Controller
{
    //
    protected $userManager;

    public function __construct(UserManager $userManager)
    {
        $this->userManager = $userManager;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('price-list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate(request(), ['name' => 'required', 'provider' => 'required']);

        $costPl = $this->userManager->getCostPl(Auth::user()->id, $request->input('provider'));
        if ($costPl == null)
            return response('You must have "My Price List". Please contact your supervisor', 403);

        $PL = DB::transaction(function () use ($request, $costPl) {
            $newPl = new PlName();
            $newPl->name = $request->input('name');
            $newPl->cost_pl_name_id = $costPl->id;
            $newPl->created_by = Auth::user()->id;
            $newPl->provider_id = $request->input('provider');
            $newPl->cost = $costPl->cost;
            $newPl->save();

            foreach ($costPl->priceLists as $item) {
                $newPlItem = $item->replicate();
                $newPlItem->pl_name_id = $newPl->id;
                $newPlItem->save();
            }
            return $newPl;
        });
        return response($PL);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $network = $this->userManager->getNetworkFromCache(Auth::user()->id);
        $pl = PlName::with(['priceLists' => function ($q) {
            $q->orderBy('package_id', 'asc');
        }, 'provider.packages' => function ($q) {
            $q->orderBy('id', 'asc');
        }, ])->find($id);
//        $pl->pl_cost = Auth::user()->priceList()->where('provider_id', $pl->provider_id)->first();
        $pl->pl_cost = $this->userManager->getCostPl(Auth::user()->id, $pl->provider_id);

        if ($pl->name == 'Default') {

            $pl->users = User::select('login', 'id', 'level')->where('type', 'admin')->whereIn('id', $network)
                ->whereNotIn('id', function ($q) use ($pl) {
                $q->select('user_id')->from('pl_name_user')->whereNotIn('pl_name_id', function ($q) use ($pl){
                    $q->select('id')->from('pl_names')->where('provider_id', '!=', $pl->provider_id)->get();
                })->get();
            })->get();
        } else {
            $pl->users;


        }

        return response($pl);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

        $arr = array(['id' => 1, 'item' => 'SIM', 'cost' => '11', 'sell' => '11'],
            ['id' => 2, 'item' => 'SIM', 'cost' => '11', 'sell' => '11'],
        );
        if ($id == 2)
            return response($arr);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $pl = PlName::find($id);
        if ($request->input('row')['item'] == 'SIM card') {
            if ($request->input('field') == 'sell') {
                $pl->cost = $request->input('row')['sell'];
                $pl->save();
            } else if ($request->input('field') == 'cost' && $pl->name == 'Default'
                && Auth::user()->level == 'Super admin'
            ) {
                $pl = $pl->plCost;
                $pl->cost = $request->input('row')['cost'];
                $pl->save();
            }
        } elseif ($request->input('row')['item'] != 'SIM card') {
            if ($request->input('field') == 'sell') {
                $pl = $pl->priceLists()->where('package_id', $request->input('row')['id'])->first();
                $pl->cost = $request->input('row')['sell'];
                $pl->save();
            } else if ($request->input('field') == 'cost' && $pl->name == 'Default'
                && Auth::user()->level == 'Super admin'
            ) {
                $pl = $pl->plCost()->first()->pricelists->where('package_id', $request->input('row')['id'])->first();
                $pl->cost = $request->input('row')['cost'];
                $pl->save();
            }
        }
//        $pl = $request->all();
//        dd($pl);
        return response('success', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $pl = PlName::find($id);
        if ($pl->created_by == Auth::user()->id && $pl->name != 'My Price List'){
            if (!empty($pl->users->toArray())){
                $authUserPl = Auth::user()->priceList()->where('provider_id', $pl->provider_id)->first();
                if ($authUserPl == null)
                    $authUserPl = PlName::where('provider_id', $pl->provider_id)->where('name', 'Default')->first();
            foreach ($pl->users as $child){
                $childPl = PlName::where([['provider_id', $pl->provider_id],
                    ['name', 'My Price List'],
                    ['created_by', $child->id]])->first();
                if ($childPl != null){
                    if ($childPl->cost_pl_name_id == $pl->id){
                            $childPl->cost_pl_name_id = $authUserPl->id;
                            $childPl->save();
                    }
                }
                $child->priceList()->detach($pl->id);
            }
            $pl->users()->detach();

        }
            foreach ($pl->priceLists as $item){
                $item->delete();
            }
            $pl->delete();
        return response(['id' => $id]);
        }
        else
            return response(['data' => 'Forbidden'], 403);
    }

    public function showUsers($id)
    {
//        $pl = PlName::find($id);
        $users = User::where('supervisor_id', Auth::user()->id)->where('type', 'admin')->with(['priceList' => function($q) use ($id){
            $q->where('pl_names.id', $id);
    }])->get();
        return response($users);
    }
    public function copyPriceList(Request $request) //TODO test this function
    {
        $pl = PlName::find($request->input('plId'));
        $costPl = PlName::where([['provider_id', $pl->provider_id],
            ['name', 'My Price List'],
            ['created_by', Auth::user()->id]])->first();
        if ($costPl == null)
            return response('You must have "My Price List". Please contact your supervisor', 403);


        $newPl = $pl->replicate();
        $newPl->name = $request->input('name');
        $newPl->created_by = Auth::user()->id;
        if ($pl->name == 'Default')
            if (Auth::user()->level != 'Super admin')
            $newPl->cost_pl_name_id = $costPl->cost_pl_name_id;
        $newPl->save();

        foreach ($pl->priceLists as $item){
            $newItem = $item->replicate();
            $newItem->pl_name_id = $newPl->id;
            $newItem->save();
        }
        return response(['data' => 'success']);
    }

    public function attacheUser(Request $request)
    {
        $transaction = DB::transaction(function () use ($request) {
//       Initialise necessary info
        $uIds = array();
        $users = $request->all();
        unset($users['plId']);
        unset($users['_token']);
        foreach ($users as $key => $item){
            $uIds[] = $key;
        }
        $pl = PlName::find($request->input('plId'));
        $authUserPl = Auth::user()->priceList()->where('provider_id', $pl->provider_id)->first();
        if ($authUserPl == null)
            $authUserPl = PlName::where('provider_id', $pl->provider_id)->where('name', 'Default')->first();
        $authUserChildren = Auth::user()->children()->where('type', 'admin')->get();

//        Clear all the attachments


            $pl->users()->detach();
        foreach ($authUserChildren as $child){
            $childPl = PlName::where([['provider_id', $pl->provider_id],
                                        ['name', 'My Price List'],
                                        ['created_by', $child->id]])->first();
            if ($childPl != null){
                if ($childPl->cost_pl_name_id == $pl->id){
            $childPl->cost_pl_name_id = $authUserPl->id;
            $childPl->save();
                }
            }
            $child->priceList()->detach($pl->id);
        }

//        Attache PL to User
        foreach ($uIds as $user){
            User::find($user)->priceList()->detach();
            $userPl = PlName::where('created_by', $user)->where('name', 'My Price List')->first();
            if ($userPl == null){
                $myPl = $pl->replicate();
                $myPl->name = 'My Price List';
                $myPl->cost_pl_name_id = $pl->id;
                $myPl->created_by = $user;
                $myPl->save();
                foreach ($pl->priceLists as $item){
                    $newItem = $item->replicate();
                    $newItem->pl_name_id = $myPl->id;
                    $newItem->save();
                }
            }
            else {
                $userPl->cost_pl_name_id = $pl->id;
                $userPl->save();
            }
            $pl->users()->attach($user);
        }
        }, 5);
        if ($transaction == null)
        return response(['data' => 'success']);
    }

    public function getMyPl($providerID)
    {
//      $myPl =  PlName::where([['provider_id', $providerID],
//            ['name', 'My Price List'],
//            ['created_by', Auth::user()->id]])->first();
//      if ($myPl)
    }


}
