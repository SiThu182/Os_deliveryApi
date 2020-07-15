<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\User;
use App\Township;
use App\Http\Resources\UserResource;
class UserDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return[
            'id' => $this->id,
            'user' => new UserResource(User::find($this->user_id)),
            'township' => new TownshipResource(Township::find($this->township_id)),
            'gender' => $this->gender,
            'nrc_no' => $this->nrc_no,
            'date_of_birth' => $this->date_of_birth,
            'address' => $this->address,
            'phone_no' => $this->phone_no,
            'role' => $this->role,
            'photo' => $this->photo,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
