<?php
/**
 * Created by PhpStorm.
 * User: mrh4ck3d
 * Date: 07/05/18
 * Time: 4:25 PM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vetmeting extends Model
{
    public $table = "usertabthree";

    protected $fillable = [
        "user_id", "datum", "borst", "heup", "buik", "onderrug", "quadricep", "adductoren", "kuiten",
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
