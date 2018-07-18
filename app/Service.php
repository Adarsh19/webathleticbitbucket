<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public $table = "services";
    protected $fillable = [
        'id','service', 'sdescription', 'company_id','sprice','user_mass','payment_time','added_by','bg_color'
    ];
    
}
