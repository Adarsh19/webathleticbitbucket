<?php
/**
 * Created by PhpStorm.
 * User: mrh4ck3d
 * Date: 07/05/18
 * Time: 5:48 PM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserOmtrekmeting extends Model
{
    public $table = "useromtrekmeting";

    protected $fillable = [
        "user_id", "datum", "borst", "schouder", "buik", "armlinks", "armrechts", "bovenbeenlinks", "bovenbeenrechts",
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
