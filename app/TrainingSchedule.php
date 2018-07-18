<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrainingSchedule extends Model
{

    public $table ="training_schedule";
    protected $fillable = [
        'id','schema_id','recurring','startdate','enddate','days'

    ];
}
