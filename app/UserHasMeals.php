<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserHasMeals extends Model
{
    public $table = "user_has_meals";
    protected $fillable = [
        'id','user_id', 'food_product_id','eatan_at','quantity','units','date'


    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
