<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    public $table = "notifications";
    protected $fillable = [
        'id','type', 'notifiable_id', 'notifiable_type','data','read_at'
    ];
}
