<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductMedias extends Model
{

    public $table = "productmedia";
    protected $fillable = [
        'name', 'price','tax','stock','category','unlimited_stock','slug','type', 'path', 'user_id','group_id',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
