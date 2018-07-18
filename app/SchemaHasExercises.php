<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchemaHasExercises extends Model
{
    #This table contains training schema and exercises saved data relations
    public $table = "schema_has_exercise";
    public $timestamps = false;
    protected $fillable = [
        'id','schema_id', 'exercise_id','sets','reps','rust','priority','ex_name','ex_meta'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
