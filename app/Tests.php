<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tests extends Model
{

    public $table = "tests";
    protected $fillable = [
        'id','test_name', 'description','type','company_id','added_by','status'
    ];
    public function questions()
    {
        return $this->hasMany(TestQuestion::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
