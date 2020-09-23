<?php

namespace App\Api\V1\Controllers;

use App\Fault;
use Illuminate\Http\Request;
use App\Events\AccidentEvent;
use App\DistrictControllingArea;
use App\RegionWoredZoneCity;
use Auth;
use Illuminate\Support\Facades\DB;
use App\Api\V1\Services\AccidentFinderService;
class FaultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $accidentFinderService;
     public function __construct(AccidentFinderService $accidentFinder){
            $this->accidentFinderService = $accidentFinder;
     }
    public function index()
    {
        //
        $faults = Fault::all();
        return $faults;
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
        $fault = new Fault();
        $fault->fault_type_id = $request->fault_type_id;
        $fault->region_id = $request->region_id;
        $fault->sub_city_zone_id = $request->sub_city_zone_id;
        $fault->woreda_city_id = $request->woreda_city_id;
        $fault->sender_phone = $request->sender_phone;
        $fault->specific_name = $request->specific_name;
        $generatedCode = $this->generateCode(4);
        $fault->code = $generatedCode;
        if($fault->save()){
           return event(new AccidentEvent($fault));
        }
       


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Fault  $fault
     * @return \Illuminate\Http\Response
     */
    public function show($type)
    {
        //
        $user = Auth::user()->district;
        $areas = DB::table('district_controlling_areas')->join('districts',function($join){
            $join->on('districts.id','district_controlling_areas.district_id');
        })->where('districts.id',$user[0]->id)->get();

        //first find district that user is assigned for.Then
        //we will find the contained area of that district after
        //that we find the same specific name with that district
        foreach($areas as $area){
             $specificName = json_decode($area->specific_name,true);
             foreach($specificName as $name){

                $accidentsBySpecificName= $this->accidentFinderService->checkAccidentsBySpecificName($name);
                if($accidentsBySpecificName!=null){
                    return $accidentsBySpecificName;
                }
             }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Fault  $fault
     * @return \Illuminate\Http\Response
     */
    public function edit(Fault $fault)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Fault  $fault
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fault $fault)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Fault  $fault
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fault $fault)
    {
        //
    }

    
    function generateCode($length = 4)
    {
        $chars = '0123456789';
        $ret = '';
        for ($i = 0; $i < $length; ++$i) {
            $random = str_shuffle($chars);
            $ret .= $random[0];
        }
        return $ret;
    }
}
