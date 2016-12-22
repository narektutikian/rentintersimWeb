<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Rentintersimrepo\users\UserManager as Manager;
use Illuminate\Support\Facades\Hash;


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
        $supervisors = array();
        if (Auth::user()->level == 'Super admin')
          $supervisors =  User::select('id', 'login', 'supervisor_id')->where('id', '!=', Auth::user()->id)->get()->toArray();
        return view('usercreate', compact('supervisors'));
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

        $user = Auth::user();
        $submiter = $user;
        $this->validate(request(), [

            'name' => 'required',
            'email' => 'required|unique:users',
//            'logo' => 'required',
            'username' => 'required',
            'password' => 'required',
            'type' => 'required',
            'level' => 'required',
//            'time_zone' => 'required',
            'email2' => 'unique:users',
//            'phone' => 'required',
//            'language_id' => 'required',
//            'sim_balance' => 'required',
//            'phone_balance' => 'required',
//            'supervisor_id' => 'required',
//


        ]);



        $newUser = [


            'name' => $request->input('name'),
            'email' => $request->input('email'),
//            'logo' => $request->input('name
            'login' => $request->input('username'),
            'password' => Hash::make($request->input('password')),
            'type' => $request->input('type'),
            'level' => $request->input('level'),
//            'time_zone' => $request->input('name
              'email2' => $request->input('email2'),
//            'phone' => $request->input('name
            'language_id' => 1,
//            'sim_balance' => $request->input('name'),
//            'phone_balance' => $request->input('name'),
          'supervisor_id' => $user->id,
            'is_active' => 1,


       ];

        if ($user->level == 'Super admin'){
            if($request->has('supervisor_id') && $request->input('supervisor_id') != $user->id){

                $submiter = User::find($request->input('supervisor_id'));
                $newUser['supervisor_id'] =  $request->input('supervisor_id');
            }
        }

        if ($this->manager->UserCreation($newUser, $submiter)){
            $createdUser = User::forceCreate($newUser);
        }
        else {

            return response('You cannot create this type of user', 401);
        }




        if($createdUser)
            return $createdUser;
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
        if($request->input('login')==Auth::user()->id)
            return redirect('dashboard');
        $admin = Auth::user();
        $user = User::find($request->input('login'));
//        print_r ($request->input('login'));
        Auth::login($user);
        $request->session()->put('imitator', $admin->id);
        return redirect('home');
    }

    public function getUserTree(){
        $tree = $this->manager->getMyNetwork(Auth::user()->id);
//        dd($tree);
        return response()->json($tree);
    }

    public function getFlatTree(){
        $tree = $this->manager->getMyFlatNetwork(Auth::user()->id);
        dd($tree);
        return response()->json($tree);
    }


}
