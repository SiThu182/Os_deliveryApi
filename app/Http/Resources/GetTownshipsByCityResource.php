<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\City;
use App\Http\Resources\CityResource;
class GetTownshipsByCityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return[
            'id' => $this->id,
            'city_id' => new CityResource(City::find($this->city_id)),  
            'township_name' => $this->township_name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}

