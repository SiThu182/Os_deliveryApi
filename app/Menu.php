<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    //
    protected $fillable = [
        'category_id','user_detail_id','menu_name','menu_photo','menu_price','description','destination'
    ];
     public function user_detail()
    {
    	return $this->belongsTo('App\UserDetail');
    }
}
