<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    //
    protected $fillable = [
        'user_id', 'user_support_id', 'message','type',
    ];

    public function user(){

        return $this->belongsTo('App\User');

    }

    public function usersupport(){

        return $this->belongsTo('App\UserSupport');

    }
}
