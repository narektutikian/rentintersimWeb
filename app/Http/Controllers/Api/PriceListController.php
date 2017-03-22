<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PlName;

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

    public function editCellPrice (Request $request)
    {
        $pl = $request->all();
        dd($pl);
//        return response('success', 200);

    }
}
