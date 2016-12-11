<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Phone;
use Excel;
use Storage;

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

        $phones = Phone::orderby('id', 'desc')->paginate(env('PAGINATE_DEFAULT'));
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
//
        ]);

        $newPhone = Phone::forceCreate([

            'phone' => $request->input('phone'),
            'state' => 'not in use',
            'initial_sim_id' => $request->input('initial_sim_id'),
            'current_sim_id' => $request->input('initial_sim_id'),
            'package_id' => $request->input('package_id'),
            'provider_id' => $request->input('provider_id'),
            'is_special' => '0',
            'is_active' => '1',


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
            'phone' => 'required|unique:phones',
//            'state' => 'required',
            'initial_sim_id' => 'required',
//            'current_sim_id' => 'required',
            'package_id' => 'required',
            'provider_id' => 'required',
//            'is_special' => 'required',
//            'is_active' => 'required',

        ]);
        //
        $phone = Phone::find($id);

        $phone->phone = $request->input('phone');
//        $phone->state = 'not in use';
        $phone->initial_sim_id = $request->input('initial_sim_id');
//         $phone-> current_sim_id = $request->input('lending');
        $phone->package_id = $request->input('package_id');
//        $phone->provider_id = $request->input('provider_id');
        if ($request->has('is_special'))
        $phone->is_special = $request->input('is_special');

//        $phone->is_active = $request->input('is_active');

        $phone->save();

        return response('number edited.');

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
        Phone::find($id)->delete();


    }

    public static function solvePhoneList($phones){
        $phonesArray = $phones;
        foreach ($phones as $key => $phone) {

            $phonesArray[$key]['current_sim_id'] = $phone->sim->number;
            $phonesArray[$key]['provider_id'] = $phone->sim->provider->name;
//            $phonesArray[$key]['package_id'] = $phone->package->name;
        }
        return $phonesArray;
    }

    public function filter($filter){

        $phones = Phone::filter($filter)->orderby('id', 'desc')->paginate(env('PAGINATE_DEFAULT'));
        $phonesArray = $this->solvePhoneList($phones);

        return view('number', compact('phonesArray'));
//        dd($phonesArray);
    }

    public function export()
    {
        $data = $this->solvePhoneList(Phone::get());
        Excel::create('Phones', function($excel) use ($data) {

            $excel->sheet('Phones', function($sheet) use($data) {

                $sheet->fromArray($data);

            });

        })->download('xlsx');

        /*

 //        fputcsv($out, array_keys($data[1]));
         $out = fopen('php://output', 'w');
         foreach($data as $line)
         {
             fputcsv($out, $line);
         }
         fclose($out);*/
    }

    public function search(Request $request)
    {
        $result = Phone::where('phone', 'LIKE', '%'.$request->input('query').'%')
                ->paginate(env('PAGINATE_DEFAULT'));
        $phonesArray = $this->solvePhoneList($result);

//        dd($simsArray);
        return view('number', compact('phonesArray'));
    }

    public function import (Request $request)
    {
        $file = null;

        if ($request->hasFile('number-file')){
            $file =  $request->file('number-file')->storeAs('public/phone', 'sim_import.xlsx');


            Excel::load('../storage/app/'.$file, function($reader) {

                // Getting all results
                $reader->ignoreEmpty();
                $results = $reader->get();
                foreach ($results as $row){
//                dd($row);
                    $query = Phone::forceCreate($row->toArray());
                    if ($query) continue;
                    else {return response()->json(['file content error']. 443);}
//
                }


            });
            Storage::delete($file);
        }
        else {return response()->json(['error uploading file'], 443);}
        return response()->json([$file]);

    }


}
