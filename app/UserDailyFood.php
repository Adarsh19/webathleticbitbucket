<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDailyFood extends Model
{

    public $table = "user_daily_food";
    protected $fillable = [
        'id','date', 'user_id','kcal','eiwit','koolhydraat','vezel','vet','kcal_baw','eiwit_baw','koolhydraat_baw','vezel_baw','vet_baw','daily_note'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
