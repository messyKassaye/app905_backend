<?php

namespace App\Api\V1\Controllers;

use App\FaultType;
use Illuminate\Http\Request;
use App\Http\Resources\FaultTypeResource;
class FaultTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $faultType = FaultType::all();
        return FaultTypeResource::collection($faultType);
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
        $faultTypes = new FaultType();
        $faultTypes->name = $request->name;
        $faultTypes->priority = $request->priority;
        if($faultTypes->save()){
            return response()->json(['status'=>true,'message'=>'Fault type stored successfully']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FaultType  $faultType
     * @return \Illuminate\Http\Response
     */
    public function show(FaultType $faultType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FaultType  $faultType
     * @return \Illuminate\Http\Response
     */
    public function edit(FaultType $faultType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FaultType  $faultType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FaultType $faultType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FaultType  $faultType
     * @return \Illuminate\Http\Response
     */
    public function destroy(FaultType $faultType)
    {
        //
    }
}
