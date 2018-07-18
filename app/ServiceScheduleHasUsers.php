<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceScheduleHasUsers extends Model
{
    public $table = "service_schedule_has_users";
    public $timestamps = false;
    protected $fillable = [
        'id','user_id','service_schedule_id','bookflag'
    ];
}
