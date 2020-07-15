<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
     protected $fillable = [
       'category_id','shop_id','item_name','item_photo','item_price','description','destination'
    ];
     public function shop()
    {
    	return $this->belongsTo('App\Shop');
    }
     public function category()
    {
    	return $this->belongsTo('App\Category');
    }
}
