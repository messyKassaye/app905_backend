<?php

namespace App\Api\V1\Controllers;

use App\RegionWoredZoneCity;
use Illuminate\Http\Request;
use App\Http\Resources\RegionWoredaZoneCityResource;
class RegionWoredZoneCityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $region = RegionWoredZoneCity::where('parent_id',0)->get();
        return RegionWoredaZoneCityResource::collection($region);
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
     * @param  \App\RegionWoredZoneCity  $regionWoredZoneCity
     * @return \Illuminate\Http\Response
     */
    public function show(RegionWoredZoneCity $regionWoredZoneCity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RegionWoredZoneCity  $regionWoredZoneCity
     * @return \Illuminate\Http\Response
     */
    public function edit(RegionWoredZoneCity $regionWoredZoneCity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RegionWoredZoneCity  $regionWoredZoneCity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RegionWoredZoneCity $regionWoredZoneCity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RegionWoredZoneCity  $regionWoredZoneCity
     * @return \Illuminate\Http\Response
     */
    public function destroy(RegionWoredZoneCity $regionWoredZoneCity)
    {
        //
    }
}
