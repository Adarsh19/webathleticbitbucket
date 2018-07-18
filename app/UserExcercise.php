<?php
/**
 * Created by PhpStorm.
 * User: mrh4ck3d
 * Date: 02/05/18
 * Time: 12:55 PM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserExcercise extends Model
{
    public $table = "userexercise";

    protected $fillable = [
        'user_id', 'date', 'datum', 'backsquat', 'benchpress','deadlift','chinups','shoulderpress',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
