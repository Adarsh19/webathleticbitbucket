<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FoodProductsUnits extends Model
{
    public $table = "food_producct_units";
    protected $fillable = [
        'id','food_product_id', 'foodunit','amount','weight','setdefault'


    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
