<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserStatus extends Model
{
    public $table = "user_statuses";
    protected $fillable = [
        'id','user_id', 'status', 'description', 'added_by', 'status_type'
    ];
}
