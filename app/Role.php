<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public $table = "roles";
    protected $fillable = [
        'id','role', 'rdescription', 'user_id','added_by'
    ];

    public function permissions()
    {
        return $this->belongsToMany(
            'App\Permission',
            'permission_pivots',
            'role_id',
            'permission_id'
        );
    }
}
