<?php

namespace App\Http\Controllers\Api;

use App\Models\Package;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PackageController extends Controller
{
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

            'type_code' => 'required|unique:sims',
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

            'type_code' => 'required|unique:sims',
            'name' => 'required',
            'description' => 'required',
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
        $package->save();

    }

    public static function solvePackageList($packages){
        $packagesArray = $packages;
        foreach ($packages as $key => $package) {
            $packagesArray[$key]['provider_id'] = $package->provider->name;
        }
        return $packagesArray;
    }

    public function filter($filter){

        $packages = Package::filter($filter)->orderby('id', 'desc')->paginate(env('PAGINATE_DEFAULT'));
        $packagesArray = $this->solvePackageList($packages);

//        dd($packagesArray);
        return view('type', compact('packagesArray'));
    }
}
