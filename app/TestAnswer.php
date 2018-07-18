<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestAnswer extends Model
{

    public $table = "test_questions_answer";
    protected $fillable = [
        'id','test_id', 'question_id','answer','added_by'
    ];

    public function test()
    {
        return $this->belongsTo(Tests::class);
    }
    public function question()
    {
        return $this->belongsTo('App\TestQuestion', 'question_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\user', 'added_by', 'id');
    }
}
