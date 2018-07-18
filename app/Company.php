<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Activitylog\Traits\LogsActivity;

class Company extends Authenticatable
{
    use Notifiable;
    use LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $table = "companies";

    protected $fillable = [
        'id','company_name','address','primary_language','City','allow_cashback','visit_location','phone_main','email_main', 'slug'
    ];

    /**
     * The attributes that are used to logging records.
     *
     * @var array
     * Team:
     * Created By:
     */
    protected static $logFillable = true;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
