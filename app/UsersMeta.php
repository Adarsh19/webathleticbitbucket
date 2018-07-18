<?php
/**
 * Created by PhpStorm.
 * User: mrh4ck3d
 * Date: 30/04/18
 * Time: 7:31 PM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\UsersMeta;

class UsersMeta extends Model
{
    public $table = "usermeta";

    protected $fillable = [
        'user_id', 'date', 'kcal', 'weight', 'training','sleep_q1','sleep_q2','sleep_q3','sleep_q4','daily_note',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
