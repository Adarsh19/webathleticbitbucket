<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExerciseAccentMuscleGroup extends Model
{

    public $table ="exercise_accent_muscle_group";
    protected $fillable = [
        'musclegroupname','user_id'
    ];
}
