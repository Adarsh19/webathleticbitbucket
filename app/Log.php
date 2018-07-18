<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    public $table = "log_events";
    protected $fillable = [
        'id','log','user_id','role'
    ];
}
