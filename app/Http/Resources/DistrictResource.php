<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\DistrictControllingArea;
use Illuminate\Support\Facades\DB;
class DistrictResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'manager'=>$this->manager,
            'region'=>DB::table('district_controlling_areas')
                      ->join('region_wored_zone_cities',function($join){
                          $join->on(['district_controlling_areas.region_id'=>
                          'region_wored_zone_cities.id']);
                      })->where('district_id',$this->id)
                      ->select('region_wored_zone_cities.id','region_wored_zone_cities.name as region_name')->get(),
         'sub_city_zone'=>DB::table('district_controlling_areas')
                      ->join('region_wored_zone_cities',function($join){
                          $join->on('district_controlling_areas.sub_city_zone_id',
                         'region_wored_zone_cities.id');
                       })->where('district_id',$this->id)
                       ->select('region_wored_zone_cities.name as sub_city_zone_name')
                       ->get(),
         'accidents'=>count(DB::table('districts')
         ->join('district_controlling_areas',function($join){
             $join->on('district_controlling_areas.district_id','districts.id');
         })->join('region_wored_zone_cities',function($join){
             $join->on('district_controlling_areas.region_id','region_wored_zone_cities.id');
         })->where('districts.id',$this->id)->get()),

     'woreda'=>DB::table('district_controlling_areas')->join('district_woredas',function($join){
         $join->on('district_woredas.district_controlling_area_id','district_controlling_areas.id');
     })->where('district_controlling_areas.district_id',$this->id)
     ->select('district_woredas.id','district_woredas.name')->get(),

     'specific_name'=>DB::table('district_controlling_areas')->join('specific_names',function($join){
         $join->on('specific_names.district_controlling_area_id','district_controlling_areas.id');
     })->where('district_controlling_areas.district_id',$this->id)
     ->select('specific_names.id','specific_names.name')->get(),
  
        'groups'=>$this->groups,
             ];
    }
}
