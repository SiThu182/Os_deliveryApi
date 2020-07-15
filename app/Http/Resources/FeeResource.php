<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Township;
use App\Http\Resources\TownshipResource;
class FeeResource extends JsonResource
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
            'from_township' => new TownshipResource(Township::find($this->from_township_id)),
            'to_township' => new TownshipResource(Township::find($this->to_township_id)),
            'cost' => $this->cost,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
