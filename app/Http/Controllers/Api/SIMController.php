<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sim;

class SIMController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $sims = Sim::get();
        $simsArray = $this->solveSimList($sims);

//      dd($simsArray);
        return view('sim', compact('simsArray'));

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
        $this->validate(request(), [

            'number' => 'required|unique:sims',
            'provider_id' => 'required',
            'state' => 'required',
//            'phone_id' => 'required',
//            'user_id' => 'required',
//            'is_active' => 1,


        ]);

        $newsim = Sim::forceCreate([


            'number' => $request->input('number'),
            'provider_id' => $request->input('provider_id'),
            'state' => $request->input('state'),
//            'phone_id' => $request->input('number'),
//            'user_id' => $request->input('number'),
            'is_active' => 1,




        ]);

        if($newsim)
            return $newsim;
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
        $this->validate(request(), [

            'number' => 'required|unique:sims',
            'provider_id' => 'required',
            'state' => 'required',
//            'phone_id' => 'required',
//            'user_id' => 'required',
//            'is_active' => 1,


        ]);

        $sim=Sim::find($id);

        $sim->number= $request->input('number');
        $sim->provider_id = $request->input('provider_id');
        $sim->state = $request->input('state');
//        $sim->phone_id = $request->input('initial_sim_id');
//        $sim->user_id = $request->input('initial_sim_id');
        $sim->is_active = $request->input('is_active');
        $sim->save();

        return $sim;
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
        $sim=Sim::find($id);
        $sim->save();
    }

    public static function solveSimList($sims){
        $simsArray = $sims->toArray();
        foreach ($sims as $key => $sim) {
            $simsArray[$key]['provider_id'] = $sim->provider->name;
        }
        return $simsArray;
    }

    public function filter($filter){

        $sims = Sim::filter($filter)->get();
        $simsArray = $this->solvesimList($sims);

//        dd($simsArray);
        return view('sim', compact('simsArray'));
    }
}
