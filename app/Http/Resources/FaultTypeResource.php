<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;
class FaultTypeResource extends JsonResource
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
            'priority'=>$this->priority,
            'accidents'=>count(DB::table('fault_types')->join('faults',function($join){
                $join->on('faults.fault_type_id','fault_types.id');
            })->get())
        ];
    }
}
