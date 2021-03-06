<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Menu;
use App\Http\Resources\MenuResource;
use App\UserDetail;
use App\Http\Resources\OrderDetailResource;
class OrderDetailResource extends JsonResource
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
            'voucher_no' => $this->voucher_no,
            'order_date' => $this->order_date,
            'menu' => new MenuResource(Menu::find($this->menu_id)),
            'qty' => $this->qty,
            'sub_total' => $this->sub_total,
            'total' => $this->total,
            'user_detail_id' => new UserDetailResource(UserDetail::find($this->user_detail_id)),  
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
