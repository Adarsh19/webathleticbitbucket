<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExerciseHasAttribute extends Model
{

    public $timestamps = false;
    public $table ="exercise_has_attributes";
    protected $fillable = [
        'id','exerciseid','attributeid','attributetype'
    ];
}
