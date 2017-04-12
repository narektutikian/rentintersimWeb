<?php

namespace App\Http\Controllers\Api;

use App\Models\Order;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sim;
use Excel;
use Storage;
use App\Models\Phone;
use Carbon\Carbon;

class SIMController extends Controller
{

    public function __construct()
    {
        $this->middleware('superAdmin');
    }


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
        elseif ($sim->state == 'parking' && $request->input('is_parking') != 'true')
                $simState = 'available';
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
            unset($simsArray[$key]['created_at']);
            unset($simsArray[$key]['updated_at']);
            unset($simsArray[$key]['is_parking']);
            unset($simsArray[$key]['is_active']);
            if ($sim->deleted_at != null){
                $simsArray[$key]['deleted'] = $simsArray[$key]['deleted_at']->format('d/m/Y H:i');
            }
//            else
                unset($simsArray[$key]['deleted_at']);
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




    public function export(Request $request)
    {
        $sims = Sim::with(['provider'  => function ($q){
                    $q->withTrashed();
                }
        ]);
        if ($request->has('filter')){
            if ($request->input('filter') != 'deleted')
                $sims = $sims->filter($request->input('filter'));
            else $sims = $sims->onlyTrashed();
        }

        Excel::create('Sim', function($excel) use ($sims) {
            $excel->sheet('SIM', function($sheet) use($sims) {

            $sheet->appendRow(array(
                'ID', 'Status', 'Number', 'Provider'
            ));
            $sheet->setColumnFormat(array('C' => '0'));
            $sheet->freezeFirstRowAndColumn();

                $sims->chunk(100, function($rows) use ($sheet)
                {
                    foreach ($rows as $row)
                    {
                        $sheet->appendRow(array(
                            $row->id, (($row->deleted_at == null)? $row->state : 'deleted'), $row->number, $row->provider->name
                        ));
                    }
                });

            });
        })->export('xlsx');

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
            $count = Phone::withTrashed()->where('initial_sim_id', $sim->id)->count();
            if ($count == 0)
                return 1;
        } else {return 0;}
    }

    public function simTable (Request $request)
    {
        $q = $request->all();
        $sims = new Sim();

        if ($request->has('sort')){
            if ($q['sort'] == 'id'){
                $sims = $sims->orderBy('id', $request->input('order'));
            }
            elseif ($q['sort'] == 'number'){
                $sims = $sims->orderBy('number', $request->input('order'));
            }
            elseif ($q['sort'] == 'state'){
                $sims = $sims->orderBy('state', $q['order']);
            }
            elseif ($q['sort'] == 'deleted_at'){
                $sims = $sims->orderBy('deleted_at', $q['order']);
            }
//
        }
        else {
            $sims = $sims->orderBy('id', 'desc');
        }
        if ($request->has('search')){
            $sims = $sims->withTrashed()->where('number', 'LIKE', '%'.$request->input('search').'%');
        }
        if ($request->has('filter')){
            if ($request->input('filter') == 'deleted')
                $sims = $sims->onlyTrashed();
            else
                $sims = $sims->where('state', $q['filter']);
        }
        $total = clone $sims;
        $total = $total->count();
        if ($q['offset'] != 0 && ($q['offset']/$q['limit']) >= (ceil($total/$q['limit'])))
            $q['offset'] = 0;
        $sims = $sims->with('provider')->take($q['limit'])->skip($q['offset'])->get();
        foreach ($sims as $sim){
            $sim->editable = $this->isEditable($sim);
        }
        return  response()->json(['total' => $total, 'rows' => $sims]);
    }

}
