<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CheckIn extends Model
{
    public $table = "check_in_log";
    protected $primaryKey = 'log_id';
    protected $fillable = [
        'user_id', 'responsee_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
