<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Category;
use App\UserDetail;
use App\Township;
use App\Http\Resources\TownshipResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\UserDetailResource;
class MenuResource extends JsonResource
{
    /**
     * Transform the resource into an array.
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
        $length = $this->length;
        $customMenu = [
            'id' => $this->id,
            'category' => new CategoryResource(Category::find($this->category_id)),
            'user_detail_id' => new UserDetailResource(UserDetail::find($this->user_detail_id)),
            'menu_name' => $this->menu_name,
            'menu_photo' => $this->menu_photo,
            'menu_price' => $this->menu_price,
            'description' => $this->description,
            'updated_at' => $this->updated_at,
            'updated_at' => $this->updated_at,
        ];
        for($i = 0; $i<$length; $i++){
            $township = "township$i";
            $menu = new TownshipResource(Township::find($this->$township));
            $customMenu["township$i"] = $menu;
        //array_push($customMenu, $menu);
        }
        return $customMenu;
        
    }
    public static function collection($resource){
        return new MenuResourceCollection($resource);
    }
}
