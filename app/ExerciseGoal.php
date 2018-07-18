<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExerciseGoal extends Model
{

    public $table = "exercise_goals";
    protected $fillable = [
        'goalname','user_id'
    ];
}
