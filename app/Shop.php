<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $fillable = [
    	'shop_name','shop_address','phone_no','township_id','shop_photo'
    ];

     public function township()
    {
    	return $this->belongsTo('App\Township');
    }
}