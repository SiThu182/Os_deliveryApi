<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Category;
use App\UserDetail;
class GetMenusByRestaurantResource extends JsonResource
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
            'category' => new CategoryResource(Category::find($this->category_id)),  
            'user_detail' => new UserDetailResource(UserDetail::find($this->user_detail_id)),  
            'menu_name' => $this->menu_name,
            'menu_photo' => $this->menu_photo,
            'menu_price' => $this->menu_price,
            'description' => $this->description,
            'destination' => $this->destination,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}

