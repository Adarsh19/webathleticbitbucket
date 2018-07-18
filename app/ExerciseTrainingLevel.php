<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExerciseTrainingLevel extends Model
{

    public $table ="exercise_training_levels";
    protected $fillable = [
        'traininglevel','user_id'
    ];
}
