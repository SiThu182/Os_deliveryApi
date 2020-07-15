<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
class MenuResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    private $length;
    public function length($townshipLength) {
        $this->length = $townshipLength; 
        return $this;// $apple param passed
    }
    public function toArray($request)
    {
        return $this->collection->map(function(MenuResource $resource) use($request){
            return $resource->length($this->length)->toArray($request);
        })->all();
    }
}
