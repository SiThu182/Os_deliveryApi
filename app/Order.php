<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
     protected $fillable = [
        'voucher_no','user_detail_id','order_date','total'
    ];
}
