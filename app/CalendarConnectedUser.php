<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CalendarConnectedUser extends Model
{

    public $table = "calendar_connected_users";
    protected $fillable = [
        'id','parent_user_id', 'user_id','user_color_code','schedule_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
