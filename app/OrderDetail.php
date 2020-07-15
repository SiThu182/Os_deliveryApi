<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    //
    protected $fillable = [
        'voucher_no','menu_id','qty','sub_total'
    ];
}
