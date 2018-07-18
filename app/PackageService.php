<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackageService extends Model
{
    public $table = "package_services";
    protected $fillable = [
        'id','package_id', 'service_id'
    ];
}
