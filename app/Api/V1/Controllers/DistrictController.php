<?php

namespace App\Api\V1\Controllers;

use App\District;
use Illuminate\Http\Request;
use App\Http\Resources\DistrictResource;
use Illuminate\Support\Facades\DB;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $districts = District::all();

        return DistrictResource::collection($districts);
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
        $district = new District();
        $district->name = $request->name;
        if($district->save()){
            return response()->json(['status'=>true,'message'=>'District stored successfully']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\District  $district
     * @return \Illuminate\Http\Response
     */
    public function show($type)
    {
        //
        if($type=='not_assigned'){
            $districts = District::whereNotIn('id',$this->assignedUser())
            ->get();

            return DistrictResource::collection($districts);
        }else{

        }
    }

    public function assignedUser(){
        $assigned = array();
        $AssignedUsers = DB::table('district_user')->select('district_id')->get();
        foreach($AssignedUsers as $user){
            array_push($assigned,$user->district_id);
        }
        return $assigned;

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\District  $district
     * @return \Illuminate\Http\Response
     */
    public function edit(District $district)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\District  $district
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, District $district)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\District  $district
     * @return \Illuminate\Http\Response
     */
    public function destroy(District $district)
    {
        //
    }
}
