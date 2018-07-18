<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserHasSchema extends Model
{
    public $table = "user_has_schema";
    public $timestamps = false;
    protected $fillable = [
        'id','user_id', 'schema_id','type'


    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
