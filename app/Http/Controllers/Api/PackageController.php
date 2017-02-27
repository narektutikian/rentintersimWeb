<?php

namespace App\Http\Controllers\Api;

use App\Models\Package;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Excel;
use Storage;

class PackageController extends Controller
{

    public function __construct()
    {
        $this->middleware('superAdmin')->except(['typeofProvider']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sims = Package::orderby('id', 'desc')->paginate(env('PAGINATE_DEFAULT'));
        $packagesArray = $this->solvePackageList($sims);

//      dd($packageArray);
        return view('type', compact('packagesArray'));
    }

    /**
     * Display a listing of the resource.
     *
     * @param int
     *
     * @return \Illuminate\Http\Response
     */
    public function typeofProvider($providerId)
    {
        $packages = Package::where('provider_id', $providerId)->get();


//      dd($packageArray);
        return response()->json($packages);
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

            'name' => 'required',
            'description' => 'required',
            'provider_id' => 'required',
//            'status' => 'required',


        ]);

        $newPackage = Package::forceCreate([

            'type_code' => $request->input('type_code'),
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'provider_id' => $request->input('provider_id'),
            'status' => $request->input('status'),

        ]);

        return response($newPackage);
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

//            'type_code' => 'required',
            'name' => 'required',
//            'description' => 'required',
            'provider_id' => 'required',
//            'status' => 'required',


        ]);

        $package=Package::find($id);

        $package->type_code = $request->input('type_code');
        $package->name = $request->input('name');
        $package->description = $request->input('description');
        $package->provider_id = $request->input('provider_id');
        $package->status = $request->input('status');
        $package->save();

        return response('type updated');
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
        $package=Package::find($id);
        $package->forceDelete();

    }

    public static function solvePackageList($packages){
        $packagesArray = $packages;
        foreach ($packages as $key => $package) {
            $packagesArray[$key]['provider_id'] = $package->provider->name;
            unset($packagesArray[$key]['deleted_at']);
            unset($packagesArray[$key]['created_at']);
            unset($packagesArray[$key]['updated_at']);
            unset($packagesArray[$key]['status']);
        }
        return $packagesArray;
    }

    public function filter($filter){
        if ($filter == "Disable")
        $packages = Package::onlyTrashed()->orderby('id', 'desc')->paginate(env('PAGINATE_DEFAULT'));
        else
            $packages = Package::orderby('id', 'desc')->paginate(env('PAGINATE_DEFAULT'));
        $packagesArray = $this->solvePackageList($packages);

//        dd($packagesArray);
        return view('type', compact('packagesArray'));
    }

    public function export()
    {
        $data = $this->solvePackageList(Package::get());
        Excel::create('Types', function($excel) use ($data) {

            $excel->sheet('Types', function($sheet) use($data) {

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
        $result = Package::where('name', 'LIKE', '%'.$request->input('query').'%')
            ->orWhere('description', 'LIKE', '%'.$request->input('query').'%')
            ->paginate(env('PAGINATE_DEFAULT'));
        $packagesArray = $this->solvePackageList($result);

//        dd($simsArray);
        return view('type', compact('packagesArray'));
    }

    public function import (Request $request)
    {
        $file = null;

        if ($request->hasFile('type-file')){
            $file =  $request->file('type-file')->storeAs('public/type', 'sim_import.xlsx');


            Excel::load('../storage/app/'.$file, function($reader) {

                // Getting all results
                $reader->ignoreEmpty();
                $results = $reader->get();
                foreach ($results as $row){
//                dd($row);

                    $query = Package::forceCreate($row->toArray());

                    if ($query) continue;

//                    else {return response()->json(['file content error']. 443);}
//
                }


            });

            Storage::delete($file);
        }
        else {return response()->json(['error uploading file'], 443);}
        return response()->json([$file]);

    }

    public function packageTable (Request $request)
    {
        $q = $request->all();
        $package = new Package();

        if ($request->has('sort')){
            if ($q['sort'] == 'id'){
                $package = $package->orderBy('id', $request->input('order'));
            }
            elseif ($q['sort'] == 'name'){
                $package = $package->orderBy('name', $request->input('order'));
            }
            elseif ($q['sort'] == 'deleted_at'){
                $package = $package->orderBy('deleted_at', $q['order']);
            }
//
        }
        else {
            $package = $package->orderBy('id', 'desc');
        }
        if ($request->has('search')){
            $package = $package->withTrashed()->where('name', 'LIKE', '%'.$request->input('search').'%')
                ->orWhere('description', 'LIKE', '%'.$request->input('search').'%');
        }
        if ($request->has('filter')){
            if ($request->input('filter') == 'Disabled')
                $package = $package->onlyTrashed();
            else
                $package = $package->where('state', $q['filter']);
        }
        $total = clone $package;
        $total = $total->count();
        if ($q['offset'] != 0 && ($q['offset']/$q['limit']) >= (ceil($total/$q['limit'])))
            $q['offset'] = 0;
        $package = $package->with('provider')->take($q['limit'])->skip($q['offset'])->get();
        return  response()->json(['total' => $total, 'rows' => $package]);
    }
}
