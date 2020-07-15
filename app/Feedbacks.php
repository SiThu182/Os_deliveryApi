<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedbacks extends Model
{
    //
    protected $fillable = [
        'user_detail_id','context'
    ];
    public function user_detail()
    {
    	return $this->belongsTo('App\UserDetail');
    }
}
