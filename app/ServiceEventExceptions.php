<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceEventExceptions extends Model
{
    public $table = "service_event_exceptions";
    protected $fillable = [
        'id','event_id', 'exdate'
    ];
}
