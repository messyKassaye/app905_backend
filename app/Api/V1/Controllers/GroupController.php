<?php

namespace App\Api\V1\Controllers;

use App\Group;
use Illuminate\Http\Request;
use Auth;
use App\Http\Resources\GroupResource;
use Illuminate\Support\Facades\DB;
class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $groups = Group::where('district_id',Auth::guard()->user()->district[0]->id)->get();
       
        return GroupResource::collection($groups);
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
        $group = new Group();
        $group->name = $request->name;
        $group->district_id = $request->district_id;
        if($group->save()){
            return response()->json(['status'=>true,'message'=>'Group is created successfully']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function show($type)
    {
        //
        if($type==='not_assigned'){
            $notAssignedGroup = DB::table('groups')
            ->whereNotIn('id',$this->assignedGroup())
            ->where('district_id',Auth::guard()->user()->district[0]->id)->get();
            return $notAssignedGroup;
        }
    }

    public function assignedGroup(){
        $assigned = array();
        $AssignedUsers = DB::table('group_user')->select('group_id')->get();
        foreach($AssignedUsers as $user){
            array_push($assigned,$user->user_id);
        }
        return $assigned;

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Group $group)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        //
    }
}
