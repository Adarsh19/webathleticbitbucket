<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserHasProducts extends Model
{
    public $table = "user_has_products";
    public $timestamps = false;
    protected $fillable = [
        'userid', 'productid','quantity','orderid','price','name','tax'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
