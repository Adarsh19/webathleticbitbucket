<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    public $table = "transactions";

    protected $fillable = [
       'id','user_id','parent_user_id', 'date', 'amount_debt','amount_received', 'note', 'payment_mode','transaction_type',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
