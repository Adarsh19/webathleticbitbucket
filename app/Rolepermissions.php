<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rolepermissions extends Model
{
    public $table = "role_credentials";
    protected $fillable = [
        'id','role_id', 'menu_id', 'submenu_id','user_id'
    ];
}
