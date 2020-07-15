<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    //
    protected $fillable = [
        'from_township_id','to_township_id','cost'
    ];
    public function from_township()
    {
    	return $this->belongsTo('App\Township','from_township_id','id');
    }
    public function to_township()
    {
    	return $this->belongsTo('App\Township','to_township_id','id');
    }
}
