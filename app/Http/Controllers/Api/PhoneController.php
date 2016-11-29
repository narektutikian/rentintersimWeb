<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Phone;

class PhoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $phones = Phone::where('is_deleted', 0)->get();
        $phonesArray = $this->solvePhoneList($phones);

//      dd($phonesArray);
        return view('number', compact('phonesArray'));
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
            'phone' => 'required',
//            'state' => 'required',
            'initial_sim_id' => 'required',
//            'current_sim_id' => 'required',
            'package_id' => 'required',
            'provider_id' => 'required',
//            'is_special' => 'required',
//            'is_active' => 'required',
//            'is_deleted' => 'required'
        ]);

        $newPhone = Phone::forceCreate([

            'phone' => $request->input('phone'),
            'state' => 'Not in use',
            'initial_sim_id' => $request->input('initial_sim_id'),
//            'current_sim_id' => $request->input('lending'),
            'package_id' => $request->input('package_id'),
            'provider_id' => $request->input('provider_id'),
            'is_special' => '0',
//            'is_active' => '1',
            'is_deleted' => '0',

        ]);

        if($newPhone)
            return $newPhone;
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
//            'phone' => 'required',
//            'state' => 'required',
//            'initial_sim_id' => 'required',
//            'current_sim_id' => 'required',
//            'package_id' => 'required',
//            'provider_id' => 'required',
//            'is_special' => 'required',
//            'is_active' => 'required',
//            'is_deleted' => 'required'
        ]);
        //
        $phone = Phone::find($id);

        $phone->phone = $request->input('phone');
//        $phone->state = 'Not in use';
        $phone->initial_sim_id = $request->input('initial_sim_id');
//         $phone-> current_sim_id = $request->input('lending');
        $phone->package_id = $request->input('package_id');
//        $phone->provider_id = $request->input('provider_id');
        $phone->is_special = '0';
        $phone->is_active = $request->input('is_active');
//        $phone->is_deleted = '0';
        $phone->save();

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
        $phone = Phone::find($id);
        $phone->is_deleted = 1;
        $phone->save();

    }

    public static function solvePhoneList($phones){
        $phonesArray = $phones->toArray();
        foreach ($phones as $key => $phone) {

            $phonesArray[$key]['current_sim_id'] = $phone->sim->number;
            $phonesArray[$key]['provider_id'] = $phone->sim->provider->name;
            $phonesArray[$key]['package_id'] = $phone->package->name;
        }
        return $phonesArray;
    }

    public function filter($filter){

        $phones = Phone::filter($filter)->get();
        $phonesArray = $this->solvePhoneList($phones);

        return view('phone', compact('phonesArray'));
//        dd($phonesArray);
    }
}
