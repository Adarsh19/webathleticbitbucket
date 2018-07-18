<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackageHistory extends Model
{
    public $table = "package_history";
    protected $fillable = [
        'type', 'user_id', 'causer_id', 'package_id'
    ];
}
