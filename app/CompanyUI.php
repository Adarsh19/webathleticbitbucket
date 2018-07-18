<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Activitylog\Traits\LogsActivity;

class CompanyUI extends Authenticatable
{
    use Notifiable;
    use LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $table = "companyui";

    protected $fillable = [
        'company_id','header','footer','background','sidemenu','text'
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
