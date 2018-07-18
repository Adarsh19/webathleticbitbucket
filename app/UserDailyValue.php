<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDailyValue extends Model
{

    public $table = "user_daily_values";
    protected $fillable = [
        'id','date', 'user_id','kcal','weight','file','sleep_q1','sleep_q2','sleep_q3','sleep_q4'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
