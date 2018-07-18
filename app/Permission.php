<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    public $table = "permissions";
    protected $fillable = [
        'id','parent_menu', 'permission', 'pdescription','user_id','added_by','route_name','dependent_routes','block_name'
    ];
}
