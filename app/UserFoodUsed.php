<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserFoodUsed extends Model
{

    public $table = "user_food_used";
    protected $fillable = [
        'id','date', 'user_id','kcal','eiwit','koolhydraat','vezel','vet','kcal_baw','eiwit_baw','koolhydraat_baw','vezel_baw','vet_baw','daily_note'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
