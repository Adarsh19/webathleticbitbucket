<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserOrders extends Model
{
    public $table = "user_orders";
    protected $fillable = [
        'userid', 'balance', 'invoiceamount', 'status',
    ];

    public function user()
    {
        return $this->belongsTo('App\User','userid','id');
    }
}
