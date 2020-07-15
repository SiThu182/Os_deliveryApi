<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\City;
use App\Http\Resources\UserDetailResource;
use App\UserDetail;
class FeedbacksResource extends JsonResource
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
            'user_detail' => new UserDetailResource(UserDetail::find($this->user_detail_id)),
            'context' => $this->context,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
