<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    //
    protected $fillable = [
        'user_id','township_id','gender','nrc_no','date_of_birth','address','phone_no','photo','role'
    ];
    public function user()
    {
    	return $this->belongsTo('App\User');
    }  
}
