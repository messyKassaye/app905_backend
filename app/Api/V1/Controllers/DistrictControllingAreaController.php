<?php

namespace App\Api\V1\Controllers;

use App\DistrictControllingArea;
use Illuminate\Http\Request;
use App\DistrictWoreda;
use App\SpecificName;
class DistrictControllingAreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $area = new DistrictControllingArea();
        $area->district_id = $request->district_id;
        $area->region_id = $request->region_id;
        $area->sub_city_zone_id = $request->sub_city_zone_id;
        $area->woreda = $request->woreda;
        $area->specific_name = $request->specific_name;
        if($area->save()){
            return response()->json(['status'=>true,'message'=>'District areas are stored successfully']);

        }
       
       /* if($area->save()){
            $woredaData = explode(',',$request->woreda);
            for($i=0;$i<count($woredaData);$i++){
                $districWoreda = new DistrictWoreda();
                 $districWoreda->name = $woredaData[$i];  
                 $area->woreda()->save($districWoreda);
            }
            
            $specificNameData = explode(',',$request->specific_name);
            for($j=0;$j<count($specificNameData);$j++){
                $specificName = new SpecificName();
                 $specificName->name = $specificNameData[$j];  
                 $area->specificName()->save($specificName);
            }
        }*/
        

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DistrictControllingArea  $districtControllingArea
     * @return \Illuminate\Http\Response
     */
    public function show(DistrictControllingArea $districtControllingArea)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DistrictControllingArea  $districtControllingArea
     * @return \Illuminate\Http\Response
     */
    public function edit(DistrictControllingArea $districtControllingArea)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DistrictControllingArea  $districtControllingArea
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DistrictControllingArea $districtControllingArea)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DistrictControllingArea  $districtControllingArea
     * @return \Illuminate\Http\Response
     */
    public function destroy(DistrictControllingArea $districtControllingArea)
    {
        //
    }
}
