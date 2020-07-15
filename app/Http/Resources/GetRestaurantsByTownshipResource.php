<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\City;
use App\User;
use App\Http\Resources\CityResource;
class GetRestaurantsByTownshipResource extends JsonResource
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
            'user' => new UserResource(User::find($this->user_id)),  
            'township' => new CityResource(City::find($this->township_id)),  
            'gender' => $this->gender,
            'nrc_no' => $this->nrc_no,
            'date_of_birth' => $this->date_of_birth,
            'address' => $this->address,
            'phone_no' => $this->phone_no,
            'role' => $this->role,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}

