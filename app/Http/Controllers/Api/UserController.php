<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Rentintersimrepo\users\UserManager as Manager;


class UserController extends Controller
{
    protected $manager;

    public function __construct(Manager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
//        $user = Auth::user()->id;
       /* $myNetwork = array();

        $distributors = User::distributor($user)->get()->toArray();
        $dealers = User::dealer($user)->get()->toArray();
        $subDealers = User::subdealer($user)->get()->toArray();
        $net = User::myNetwork($user)->get()->toArray();

        $myNetwork['distributors'] = $distributors;
        $myNetwork['dealers'] = $dealers;
        $myNetwork['subdealers'] = $subDealers;
        $myNetwork['myNetwork'] = $net;

         dd($myNetwork);*/
        $done = array();
//       $net = $this->manager->getMyNetwork($user);
//        $new = $net[0];
//        unset($new['child']);
//        $done[] = $new;
//        $done[] = $net[0];
//        echo '<pre>';
//        dd($net);
        return view('user');
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

    public function showImitation(){
        $user = Auth::user();
        if($user->level == 'Super admin'){
            $net = User::select('id', 'login')->where('id', '!=', $user->id)->get()->toArray();
            return view('auth.imitate', compact('net'));
        }

    }

    public function imitate(Request $request){
        $admin = Auth::user();
        $user = User::find($request->input('login'));
//        print_r ($request->input('login'));
        Auth::login($user);
        $request->session()->put('imitator', $admin->id);
        return redirect('home');
    }


}
