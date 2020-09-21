<?php

namespace App\Api\V1\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\User;
use App\RegionWoredZoneCity;

class ConfigController extends Controller
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
        //add region
        $region = new RegionWoredZoneCity();
        $region->parent_id = 0;
        $region->name = 'Addis Ababa';
        $region->save();

        $woreda = new RegionWoredZoneCity();
        $woreda->parent_id = 1;
        $woreda->name = '9';
        $woreda->save();
        $superAdmin = new Role();
        $superAdmin->name = 'Super admin';
        if($superAdmin->save()){
            $admin = new Role();
            $admin->name = 'Admin';
            $admin->save();

            $districtManager = new Role();
            $districtManager->name = 'District manager';
            $districtManager->save();

            $user = new User();
            $user->first_name = 'Meseret';
            $user->last_name ='Kassaye';
            $user->email ='meseret.kassaye@gmail.com';
            $user->phone = '0923644545';
            $user->password = 'nuryelove1998';
            $user->save();
            $user->role()->sync(Role::find(1));
        }

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
}
