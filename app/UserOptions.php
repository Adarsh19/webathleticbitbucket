<?php
/**
 * Created by PhpStorm.
 * User: mrh4ck3d
 * Date: 03/05/18
 * Time: 12:41 PM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserOptions extends Model
{
    public $table = "useroptions";

    protected $fillable = [
        'user_id', 'date', 'option_name', 'option_value',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
