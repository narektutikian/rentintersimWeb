<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PlName;
use Illuminate\Support\Facades\Auth;
use DB;

class PriceListController extends Controller
{
    //
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate(request(), ['name' => 'required', 'provider' => 'required']);

        $costPl = Auth::user()->priceList()->where('provider_id', $request->input('provider'))->first();
        if ($costPl == null)
            return response('You must have \"My Price List\".', 403);

        $PL = DB::transaction(function () use ($request, $costPl) {
            $newPl = new PlName();
            $newPl->name = $request->input('name');
            $newPl->cost_pl_name_id = $costPl->id;
            $newPl->created_by = Auth::user()->id;
            $newPl->provider_id = $request->input('provider');
            $newPl->cost = $costPl->cost;
            $newPl->save();

            foreach ($costPl->priceLists as $item){
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $pl = PlName::with(['priceLists' => function ($q){
            $q->orderBy('package_id', 'asc');
        }, 'priceLists', 'provider.packages' => function ($q){
        $q->orderBy('id', 'asc');
    }, 'plCost', 'plCost.priceLists' => function ($q){
            $q->orderBy('package_id', 'asc');
        }])->find($id);
        $pl->users;
        return response($pl);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
         $arr = array(['id' => 1, 'item' => 'SIM', 'cost'=> '11', 'sell'=> '11'],
                            ['id' => 2, 'item' => 'SIM','cost'=> '11','sell'=> '11'],
                            );
        if ($id == 2)
            return response($arr);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $pl = PlName::find($id);
        if ($request->input('row')['item'] == 'SIM card'){
            if ($request->input('field') == 'sell'){
                $pl->cost =  $request->input('row')['sell'];
                $pl->save();
            }
            else if ($request->input('field') == 'cost' && $pl->name == 'Default'
                && Auth::user()->level == 'Super admin'){
                $pl = $pl->plCost;
                $pl->cost = $request->input('row')['cost'];
                $pl->save();
            }
        }
        elseif ($request->input('row')['item'] != 'SIM card'){
            if ($request->input('field') == 'sell'){
                $pl = $pl->priceLists()->where('package_id', $request->input('row')['id'])->first();
                $pl->cost =  $request->input('row')['sell'];
                $pl->save();
            }
            else if ($request->input('field') == 'cost' && $pl->name == 'Default'
                && Auth::user()->level == 'Super admin'){
                $pl = $pl->plCost()->priceLists()->where('package_id', $request->input('row')['id'])->first();;
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
