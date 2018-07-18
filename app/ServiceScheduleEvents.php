<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceScheduleEvents extends Model
{
    public $table = "service_events";
    protected $fillable = [
        'id','title','start', 'end', 'all_day','service_schedule_id','location','notes','url','reminder','rrule','duration','editable','can_user_book','backgroundColor','borderColor'
    ];
}
