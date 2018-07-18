<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    public $table = "subscriptions";
    protected $fillable = [
        'id','name', 'email', 'created_at','updated_at'
    ];

    public function validate($inputs)
    {
        $rules = [
            'name' => 'required|max:50',
            'email' => 'required|email',
        ];
        $messages = [
            'name.required'=>'Helaas u bent uw naam / email vergeten.',
            'email.required'=>'Helaas u bent uw naam / email vergeten.',
        ];

        return \Validator::make($inputs, $rules, $messages);
    }
}
