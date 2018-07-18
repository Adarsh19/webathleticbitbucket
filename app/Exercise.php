<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{

    public $table = "exercises";
    protected $fillable = [
        'id','name', 'slug', 'path', 'user_id','price','tax','group_id','group_priority','barcode'
    ];
}
