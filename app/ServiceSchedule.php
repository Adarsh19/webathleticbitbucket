<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceSchedule extends Model
{
    public $table = "service_schedules";
    protected $fillable = [
        'id','color','title', 'hidden', 'user_id','role','dragdrop'
    ];
}
