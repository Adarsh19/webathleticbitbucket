<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

//use Spatie\Activitylog\Traits\LogsActivity;

class User extends Authenticatable
{
    use Notifiable;
    //use LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'username', 'password','user_id', 'avatar', 'role', 'user_meta', 'activation_status', 'gender', 'phone', 'address', 'facebook', 'twitter', 'google_plus', 'linkedin', 'about','packagefk','sign'

    ];

    /**
     * The attributes that are used to logging records.
     *
     * @var array
     * Team: Skew Soft
     * Created By: Arif Pavel
     */
    //protected static $logFillable = true;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roleDetails()
    {
        return $this->belongsTo('App\Role');
    }
    public function package()
    {
        return $this->belongsTo('App\Package', "packagefk");
    }
}
