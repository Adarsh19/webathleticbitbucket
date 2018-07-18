<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductGroups extends Model
{

    public $table = "productgroup";
    protected $fillable = [
        'id','name', 'slug', 'parent_id', 'imagepath', 'user_id','group_type'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
