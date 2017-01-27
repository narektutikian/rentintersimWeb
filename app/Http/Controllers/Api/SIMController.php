<?php

namespace App\Http\Controllers\Api;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sim;
use Excel;
use Storage;
use App\Models\Phone;

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
        $sims = Sim::orderby('id', 'desc')->paginate(env('PAGINATE_DEFAULT'));
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
//            'state' => 'required',
//            'phone_id' => 'required',
//            'user_id' => 'required',
//            'is_active' => 1,


        ]);
        $simState = 'available';
        if ($request->input('is_parking') == 'true')
            $simState = 'parking';

        $newsim = Sim::forceCreate([


            'number' => $request->input('number'),
            'provider_id' => $request->input('provider_id'),
            'state' => $simState,
//            'phone_id' => $request->input('number'),
//            'user_id' => $request->input('number'),
//            'is_active' => 1,




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

            'number' => 'required',
            'provider_id' => 'required',
//            'is_parking' => 'required',
//            'phone_id' => 'required',
//            'user_id' => 'required',
//            'is_active' => 1,
        ]);


        $sim=Sim::find($id);
        $simState = '';
        if ($request->input('is_parking') == 'true')
            $simState = 'parking';
        else $simState = $sim->state;


        if ($request->input('number') != $sim->number)
            $this->validate(request(), ['number' => 'unique:sims']);
        $sim->number= $request->input('number');
        $sim->provider_id = $request->input('provider_id');
        $sim->state = $simState;
//        $sim->phone_id = $request->input('initial_sim_id');
//        $sim->user_id = $request->input('initial_sim_id');
//        $sim->is_active = $request->input('is_active');
        $sim->save();

        return response()->json(['sim updated'], 200);
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
        $sim = Sim::find($id);
        if ($this->isEditable($sim))
            $sim->delete();
        else
            return response()->json(['sim' => 'deletion not allowed'], 403);

        return response()->json(['sim' => 'deleted'], 200);
    }

    public function solveSimList($sims){
        $simsArray = $sims;
        foreach ($sims as $key => $sim) {
            $simsArray[$key]['provider_id'] = $sim->provider->name;
            unset($simsArray[$key]['phone_id']);
            unset($simsArray[$key]['user_id']);
            unset($simsArray[$key]['deleted_at']);
            unset($simsArray[$key]['created_at']);
            unset($simsArray[$key]['updated_at']);
            $simsArray[$key]['editable'] = $this->isEditable($sim);
        }
        return $simsArray;
    }

    public function filter($filter){
        $sims = [];
        if ($filter == 'deleted')
            $sims = Sim::onlyTrashed()->orderby('id', 'desc')->paginate(env('PAGINATE_DEFAULT'));
        else
        $sims = Sim::filter($filter)->orderby('id', 'desc')->paginate(env('PAGINATE_DEFAULT'));
        $simsArray = $this->solvesimList($sims);

//        dd($simsArray);
        return view('sim', compact('simsArray'));
    }

    public function export()
    {
        ini_set('memory_limit','60m');
        $data = $this->solveSimList(Sim::get());
        Excel::create('Sims', function($excel) use ($data) {

            $excel->sheet('Sim', function($sheet) use($data) {

                $sheet->fromArray($data);

            });


        })->export('xlsx');

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
        $result = Sim::where('number', 'LIKE', '%'.$request->input('query').'%')->paginate(env('PAGINATE_DEFAULT'));
        $simsArray = $this->solvesimList($result);

//        dd($simsArray);
        return view('sim', compact('simsArray'));
    }

    public function import (Request $request)
    {
        $file = null;

        if ($request->hasFile('sim-file')){
            $file =  $request->file('sim-file')->storeAs('public/sim', 'sim_import.xlsx');


        Excel::load('../storage/app/'.$file, function($reader) {

            // Getting all results
            $reader->ignoreEmpty();
            $results = $reader->get();
            foreach ($results as $row){

                $entity = $row->toArray();
//                dd($entity);
                if ($this->validNumber($entity['number'])) {
//                    dd($entity);
                    $query = Sim::forceCreate($entity);
                    if ($query) continue;
                    else {
                        return response('file content error', 403);
                    }
                } else {
                    return response('duplicate entry', 403);
                }
//
            }


        });
            Storage::delete($file);
        }
        else {return response()->json(['error uploading file'], 403);}
        return response()->json("process finished check results");

    }

    public function validNumber($number)
    {
        $count = Sim::where('number', $number)->count();
//        dd($count);
        if ($count == 0)
        return true;
        else
            return false;
    }

    public function recover($id)
    {
        $sim = Sim::onlyTrashed()->find($id);
        $sim->restore();
        return $sim;
    }

    public function isEditable($sim)
    {
        if ($sim->state == 'available')
            return 1;
        elseif ($sim->state == 'parking'){
            $count = Phone::where('initial_sim_id', $sim->id)->count();
            if ($count == 0)
                return 1;
        } else {return 0;}
    }

}
