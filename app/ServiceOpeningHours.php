<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceOpeningHours extends Model
{
    public $table = "service_opening_hours";
    protected $fillable = [
        'id','business_days','business_hours', 'min_time','max_time','user_id'
    ];
}
