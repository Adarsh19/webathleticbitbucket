<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrainingSchema extends Model
{

    public $table ="training_schema";
    protected $fillable = [
        'id','parent_id','status','schema_name','schema_note'
    ];
}
