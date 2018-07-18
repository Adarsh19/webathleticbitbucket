<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExerciseMaterial extends Model
{

    public $table ="exercise_material";
    protected $fillable = [
        'materiallevel','user_id'
    ];
}
