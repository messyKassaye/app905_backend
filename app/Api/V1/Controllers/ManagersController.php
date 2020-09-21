<?php

namespace App\Api\V1\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
use App\District;
use App\Role;
use App\Http\Resources\ManagersResource;
class ManagersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = User::where('id','!=',1)->get();
        return ManagersResource::collection($user);
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
        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = $request->password;
        if($user->save()){
            $user->role()->sync(Role::find(2));
            return response()->json(['status'=>true,
            'message'=>'Manager is stored successfully']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($type)
    {
        //
        if($type=='all'){
            return 'All';
        }else{
            $AssignedUsers = DB::table('district_user')->select('user_id')->get();
            $managers = DB::table('users')
            ->where('id','!=','1')
            ->whereNotIn('id',$this->assignedUser())
            ->select('users.id','users.first_name','users.last_name','users.phone')
                        ->get();

            return $managers;
        }
    }

    public function assignedUser(){
        $assigned = array();
        $AssignedUsers = DB::table('district_user')->select('user_id')->get();
        foreach($AssignedUsers as $user){
            array_push($assigned,$user->user_id);
        }
        return $assigned;

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
        $manager = User::find($id);
        $manager->district()->sync(District::find($request->district_id));
        return response()->json(['status'=>true,'message'=>'Manager updated successfully']);
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
}
