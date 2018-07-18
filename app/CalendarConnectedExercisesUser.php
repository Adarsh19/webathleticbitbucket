<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CalendarConnectedExercisesUser extends Model
{

    public $table = "calendar_connected_exercises_users";
    protected $fillable = [
        'id','parent_user_id', 'user_id','user_color_code'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
