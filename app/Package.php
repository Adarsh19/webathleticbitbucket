<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    public $table = "packages";
    protected $fillable = [
        'id','days', 'credits', 'company_id','bg_color', 'pro_rato','expand_automatically','Start_fee','entree','user_id','role_id','max_users','sell_category','enquette','created_at','updated_at','added_by','payment_days','name','day_price'
    ];
    public function company()
    {
        return $this->belongsTo('App\Company');
    }
}
