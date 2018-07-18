<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PermissionPivot extends Model
{
    public $table = "permission_pivots";
    protected $fillable = [
        'id','role_id','permission_id','user_id'
    ];
}
