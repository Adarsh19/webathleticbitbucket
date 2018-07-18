<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestQuestion extends Model
{

    public $table = "test_questions";
    protected $fillable = [
        'id','test_id', 'question','type','show_graph','added_by','status'
    ];

    public function test()
    {
        return $this->belongsTo(Tests::class);
    }
}
