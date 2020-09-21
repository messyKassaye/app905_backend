<?php

namespace App\Http\Resources;

use App\Advert;
use App\Car;
use App\CarAdvert;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'type' => ['User data'],
            'attribute' => [
                'id' => $this->id,
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'email' => $this->email,
                'phone' => $this->phone,
                'avator' => $this->avator,
            ],
            'relations' => [
                'role' => $this->role,
            ],
            'helpers' => [
                'today_date' => Carbon::today()->toDateString()
            ]

        ];
    }

    public function totalAdvert($userId,$columnName){
        $cars = Car::where($columnName,$userId)->get();
        $totalAdvert=0;
        foreach ($cars as $car){
            $totalAdvert += count(CarAdvert::where(['car_id'=>$car->id])->get());
        }
        return $totalAdvert;
    }

    public function findMediaNumber($userId,$mediaId,$columnName){
        $count = DB::table('cars')->join('car_adverts',function ($join){
            $join->on('cars.id','car_adverts.car_id');
        })->join('adverts',function ($join){
            $join->on('adverts.id','car_adverts.advert_id');
        })->where(['cars.'.$columnName=>$userId,'adverts.advertisement_media_type_id'=>$mediaId])->get();

        return count($count);
    }
}
