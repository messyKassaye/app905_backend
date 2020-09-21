<?php

namespace App\Api\V1\Controllers;

use App\Fault;
use Illuminate\Http\Request;
use App\Events\AccidentEvent;
class FaultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        $fault = Fault::where('status',false)->get();
        return $fault;
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
