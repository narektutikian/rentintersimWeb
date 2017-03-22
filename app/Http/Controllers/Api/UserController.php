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
        $this->middleware('superAdmin')->only(['showImitation', 'imitate']);
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
//        $done = array();
//       $net = $this->manager->getMyNetwork($user);
//        $new = $net[0];
//        unset($new['child']);
//        $done[] = $new;
//        $done[] = $net[0];
//        echo '<pre>';
//        dd($net);
        if (Auth::user()->type == 'employee')
            return redirect('home');
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

        $type = 'admin';
        if ($request->has('type'))
            $type = $request->input('type');
        $user = Auth::user();
        $submiter = $user;
        $this->validate(request(), [

            'name' => 'required',
            'email' => 'required|unique:users',
//            'logo' => 'required',
            'username' => 'required|unique:users,login',
            'password' => 'required',
//            'type' => 'required',
//            'level' => 'required',
//            'time_zone' => 'required',
            'email2' => 'unique:users',
//            'phone' => 'required',
//            'language_id' => 'required',
//            'sim_balance' => 'required',
//            'phone_balance' => 'required',
//            'supervisor_id' => 'required',
        ]);

        $newUser = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
//            'logo' => $request->input('name
            'login' => $request->input('username'),
            'password' => Hash::make($request->input('password')),
            'type' => $type,
            'level' => $request->input('level'),
//            'time_zone' => $request->input('name
              'email2' => $request->input('email2'),
//            'phone' => $request->input('name
//            'language_id' => 1,
//            'sim_balance' => $request->input('name'),
//            'phone_balance' => $request->input('name'),
          'supervisor_id' => $user->id,
            'is_active' => 1,
       ];

//        if ($user->level == 'Super admin'){
            if($request->has('supervisor_id') && $request->input('supervisor_id') != $user->id){

                $submiter = User::find($request->input('supervisor_id'));
                $newUser['supervisor_id'] =  $request->input('supervisor_id');
            }
//        }

        if ($newUser['type'] == 'admin'){
            if ($submiter->level == 'Super admin')
                $newUser['level'] = 'Distributor';
            elseif ($submiter->level == 'Distributor')
                $newUser['level'] = 'Dealer';
            elseif ($submiter->level == 'Dealer')
                $newUser['level'] = 'Subdealer';
        }
        elseif ($submiter->level != 'Super admin')
            $newUser['level'] = $submiter->level;
        else
            return response('Super admin cannot have \'Manager\' or \'Employee\' ', 401);

        if ($submiter->level == 'Subdealer' && $type == 'admin')
            return response('Please select type Manager or Employee', 401);
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
        $user = User::find($id);
        return response($user);
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
        //


        $this->validate(request(), [

            'name' => 'required',
            'email' => 'required',
//            'logo' => 'required',
            'username' => 'required',
//            'password' => 'required',
            'type' => 'required',
//            'level' => 'required',
//            'time_zone' => 'required',
//            'email2' => 'unique:users',
//            'phone' => 'required',
//            'language_id' => 'required',
//            'sim_balance' => 'required',
//            'phone_balance' => 'required',
//            'supervisor_id' => 'required',
        ]);


        $user = User::find($id);
        $userType = $user->type;
//        $userLevel = $user->level;
        $submiter = User::find($user->supervisor_id);
            $user->name = $request->input('name');

        if ($request->has('email') && $request->input('email') != $user->email){
            $this->validate(request(), ['email' => 'unique:users,email']);
            $user->email = $request->input('email');
        }
//            'logo' => $request->input('name
        if ($request->has('username') && $request->input('username') != $user->login){
            $this->validate(request(), ['username' => 'unique:users,login']);
            $user->login = $request->input('username');
        }

        if ($request->has('password'))
            $user->password = Hash::make($request->input('password'));

        if($userType == 'admin' && $request->input('type') != 'admin')
            return response('You cannot change type admin', 403);

            $user->type = $request->input('type');
//            $user->level = $request->input('level');

        if ($request->has('email2') && $request->input('email2') != $user->email2){
            $this->validate(request(), ['email2' => 'unique:users,email2']);
            $user->email2 = $request->input('email2');
        }
//            $user->language_id = 1;
//            $user->is_active = 1;
//            'phone' => $request->input('name
//            'sim_balance' => $request->input('name'),
//            'phone_balance' => $request->input('name'),
//            $user->supervisor_id = $user->id;
//            'time_zone' => $request->input('name




        if ($user->level == 'Super admin'){
            if($request->has('supervisor_id') && $request->input('supervisor_id') != $user->supervisor_id){

                $submiter = User::find($request->input('supervisor_id'));
                $user->supervisor_id =  $request->input('supervisor_id');
            }

        }
        if ($userType != 'admin'){
            if ($this->manager->UserEdit($user, $submiter)){
                $user->save();
            }
        }
        elseif ($userType == 'admin')
            $user->save();
        else {

            return response('You cannot create this type of user', 401);
        }





            return $user;
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
        if (Auth::user()->level == 'Super admin'){
           $user = User::find($id);
            if($user->level != 'Super admin')
            $this->manager->deleteUser($user);
            return response('success');
        }
        else {return response('forbidden', 403);}
    }

    public function showImitation(){
        $user = Auth::user();
        if($user->level == 'Super admin'){
            $net = User::select('id', 'login')->where('id', '!=', $user->id)->get()->toArray();
            return view('auth.imitate', compact('net'));
        }

    }

    public function imitate(Request $request){
        $this->validate(request(), ['login' => 'required']);
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
//       dd($tree);
        return response()->json($tree);
    }

    public function getFlatTree(){
        $tree = $this->manager->getMyFlatNetwork(Auth::user()->id);
//        dd($tree);
        return response()->json($tree);
    }

    public function getIdTree(){
        $tree = $this->manager->getMyFlatNetwork(Auth::user()->id);
        $tree = $this->manager->subNetID($tree);
        return response()->json($tree);
    }

    public function getByLevel($level){
        $tree = $this->manager->subNetID($this->manager->getMyFlatNetwork(Auth::user()->id));
        if ($level == 'All')
            $users = User::select('id', 'login', 'supervisor_id', 'type')->whereIn('id', $tree)->get()->toArray();
        else
        $users = User::select('id', 'login', 'supervisor_id', 'type')->where('level', $level)->whereIn('id', $tree)->get()->toArray();
        return response()->json($users);
    }

}
